<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Test;
use App\Group;
use App\Module;
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
			$group->tests = $group->tests;
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
		    return redirect()->route('tests')->with('status', $validator->errors());
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
		if(Auth::user()->role == 'STUDENT'){
			return view('pages.test', ['test' => $test]);
		}else{
			return view('pages.admin_test', ['test' => $test]);
		}
	}
}
