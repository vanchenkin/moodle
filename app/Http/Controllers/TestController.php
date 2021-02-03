<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Test;
use App\Group;
use App\Module;
use App\Attempt;
use Carbon\Carbon;

class TestController extends Controller
{
	public function index()
	{
		if(Auth::user()->role != 'STUDENT' && Auth::user()->role != 'TEACHER')
			$groups = Group::all();
		else
			$groups = Auth::user()->groups;
		foreach($groups as $group){
			foreach($group->tests as $test){
				if($test->end->lessThan(Carbon::now()))
					$test->status = "Завершён";
				else if($test->start->lessThan(Carbon::now()))
					$test->status = "Идёт";
				else
					$test->status = "Не начат";
			}
		}
		return view('pages.tests', ['groups' => $groups]);
	}

	public function create(Group $group)
	{
		$modules = Module::all();
		foreach($modules as $module)
			$module->count = $module->tasks()->count();
		return view('pages.create_test', ['group' => $group, 'modules' => $modules]);
	}

	public function add(Request $request, Group $group)
	{
		if(Auth::user()->role == 'TEACHER' && !Auth::user()->groups()->find($group))
			return redirect()->route('tests')->with('status', 'Ошибка 6!');
		$validator = Validator::make($request->all(),
		    [
		        'name' => 'required',
		        'start' => 'date|required',
		        'end' => 'date|required',
		        'duration' => 'integer|required|min:1',
		        'modules' => 'required',
		    ]
		);
		if ($validator->fails())
		    return redirect()->route('test_create', $group)->with('status', $validator->errors());
		$start = Carbon::parse($request->input('start'));
		$end = Carbon::parse($request->input('end'));
		$modules = Module::with('tasks')->find($request->input('modules'));
		$count = $request->input('count');
        if($start->lessThan($end) && count($modules) == count($request->input('modules'))){
        	foreach($modules as $module){
	        	if(!array_key_exists($module->id, $count))
	        		return redirect()->route('tests')->with('status', 'Ошибка 1!');
	        	if($count[$module->id] == null)
            		$count[$module->id] = $module->tasks()->count();
	        	if($module->tasks()->count() < $count[$module->id])
	        		return redirect()->route('tests')->with('status', 'Ошибка 2!');
        	}
            $test = new Test;
            $test->name = $request->input('name');
            $test->start = $start;
            $test->end = $end;
            $test->duration = $request->input('duration');
            $test->group_id = $group->id;
            $test->save();
            foreach($modules as $module)
            	$test->modules()->attach($module, ['count' => $count[$module->id]]);
            return redirect()->route('tests')->with('status', 'Тест успешно добавлен!');
        }
        return redirect()->route('tests')->with('status', 'Ошибка 4!');
	}

	public function test(Test $test)
	{
		//status
		//0 - not started globally
		//1 - not started
		//2 - started
		//3 - ended
		//4 - ended globally
		//5 - ended globally not passed
		if(Auth::user()->role == 'TEACHER' && !Auth::user()->groups()->find($test->group))
			return view('denied');
		if(Auth::user()->role == 'STUDENT'){
			$attempt = $test->attempts()->where('user_id', Auth::user()->id)->first();
			$status = 0;
			$tasks = null;
			$remain = 0;
			$sum = 0;
			if($test->start->lessThan(Carbon::now()))
				$status = 1;
			if($test->end->lessThan(Carbon::now()))
				$status = 5;
			if($attempt){
				$start = $attempt->start;
				$tasks = $attempt->tasks;
				$end = $attempt->start->addMinutes($test->duration)->minimum($test->end);
				if($attempt->end == null && $start->lessThan(Carbon::now()) && $end->greaterThan(Carbon::now())){
					$status = 2;
					$remain = $end->diffInSeconds(Carbon::now());
				}else if($test->end->greaterThan(Carbon::now())){
					$status = 3;
				}else{
					foreach($tasks as $task){
						if($task->answer == $task->pivot->answer){
							$task->mark = 1;
							$sum++;
						}
						else
							$task->mark = 0;
						$task->yanswer = $task->pivot->answer;
					}
					$status = 4;
				}
			}
			return view('pages.test', ['test' => $test, 'attempt' => $attempt, 'status' => $status, 'tasks' => $tasks, 'remain' => $remain, 'sum' => $sum, 'count' => $test->count()]);
		}else{
			$users = $test->group->users()->where('role', 'STUDENT')->get();
			$count = $test->count();
			foreach($users as $user){
				$attempt = $user->attempts()->where('test_id', $test->id)->first();
				if($attempt){
					$tasks = $attempt->tasks;
					$sum = 0;
					foreach($tasks as $task)
						if($task->answer == $task->pivot->answer)
							$sum++;
				}else{
					$sum = -1;
				}
				$user->mark = $sum;
			}
			return view('pages.admin_test', ['test' => $test, 'users' => $users, 'count' => $count]);
		}
	}

	public function start(Test $test)
	{
		if(Auth::user()->role == 'STUDENT' && $test->attempts()->where('user_id', Auth::user()->id)->count() == 0 && $test->start->lessThan(Carbon::now()) && $test->end->greaterThan(Carbon::now())){
			$can = false;
			foreach(Auth::user()->groups as $group)
				if($group->tests()->find($test)) $can = true;
			if($can){
				$attempt = new Attempt;
				$attempt->user_id = Auth::user()->id;
				$attempt->test_id = $test->id;
				$attempt->start = Carbon::now();
				$attempt->save();
				foreach($test->modules as $module){
					$tasks = $module->tasks->all();
					$nums = array_rand($tasks, $module->pivot->count);
					if(!is_array($nums))
						$nums = array($nums);
					foreach($nums as $num)
						$attempt->tasks()->attach($tasks[$num]);
				}
				return redirect()->route('test', $test)->with('status', 'Вы начали тест!');
			}
		}
	}

	public function end(Request $request, Attempt $attempt){
		$start = $attempt->start;
		$end = $attempt->start->addMinutes($attempt->test->duration)->minimum($attempt->test->end);
		if($attempt->end == null && $start->lessThan(Carbon::now()) && $end->greaterThan(Carbon::now()) && Auth::user()->attempts()->find($attempt)){
			$answers = $request->input('answers');
			foreach($answers as $id=>$answer){
				if($answer == null) $answer = '';
				$task = $attempt->tasks()->find($id);
				$task->pivot->answer = $answer;
				$task->pivot->save();
			}
			$attempt->end = Carbon::now();
			$attempt->save();
			return redirect()->route('test', $attempt->test)->with('status', 'Вы завершили тест!');
		}
		return redirect()->route('test', $attempt->test)->with('status', 'Тест уже завершён!');
	}
}