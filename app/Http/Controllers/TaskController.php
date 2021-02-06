<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Module;

class TaskController extends Controller
{
    public function index()
    {
        $modules = Module::with('tasks')->get();
        return view('pages.tasks', ['modules' => $modules]);
    }

    public function create(Module $module)
    {
        return view('pages.create_task', ['module' => $module]);
    }

    public function add(Request $request, Module $module)
    {
        $text = $request->input('text');
        $answer = $request->input('answer');
        if($text && $answer){
            Task::create(['text' => $text, 'answer' => $answer, 'module_id' => $module->id]);
            return redirect()->route('tasks')->with('status', 'Задание успешно добавлено!');
        }
        return redirect()->route('task_create', $module)->with('status', 'Пустой ответ или текст!');
    }

    public function delete(Request $request){
    	$task = Task::find($request->id);
    	if($task){
	    	$task->delete();
	    	return redirect()->route('tasks')->with('status', 'Задание удалено!');
	    }
	    return redirect()->route('tasks')->with('status', 'Задание не найдено!');
    }

    public function change(Request $request, Task $task)
    {
        $text = $request->input('text');
        $answer = $request->input('answer');
        if($text && $answer){
            $task->text = $text;
            $task->answer= $answer;
            $task->save();
            return redirect()->route('tasks')->with('status', 'Задание успешно изменено!');
        }
        return redirect()->route('task_update', $task)->with('status', 'Пустой ответ или текст!');
    }

    public function update(Request $request, Task $task)
    {
        return view('pages.update_task', ['task' => $task]);
    }

    public function task(Request $request, Task $task)
    {
        return view('pages.task', ['task' => $task]);
    }
}
