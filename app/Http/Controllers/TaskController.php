<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        $modules = Module::with('tasks')->get();
        return view('pages.tasks', ['modules' => $modules]);
    }

    public function delete(Request $request){
    	$tmp = Task::find($request->id);
    	if($tmp){
	    	$tmp->delete();
	    	return redirect()->route('tasks')->with('status', 'Задание удалено!');
	    }
	    return redirect()->route('tasks')->with('status', 'Ошибка!');
    }
}
