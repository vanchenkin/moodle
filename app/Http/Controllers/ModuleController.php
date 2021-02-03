<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class ModuleController extends Controller
{
	public function delete(Request $request){
    	$module = Module::find($request->id);
    	if($module){
	    	$module->delete();
	    	return redirect()->route('tasks')->with('status', 'Модуль удален!');
	    }
	    return redirect()->route('tasks')->with('status', 'Ошибка!');
    }

    public function create(Request $request)
    {
    	$name = $request->input('name');
    	if($name){
    		Module::create(['name' => $name]);
    		return redirect()->route('tasks')->with('status', 'Модуль успешно добавлен!');
    	}else{
    		return redirect()->route('tasks')->with('status', 'Ошибка!');
    	}
    }

    public function index()
    {
        return view('pages.create_module');
    }
}
