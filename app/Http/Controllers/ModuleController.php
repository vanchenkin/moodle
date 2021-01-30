<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class ModuleController extends Controller
{
	public function delete(Request $request){
    	$tmp = Module::find($request->id);
    	if($tmp){
	    	$tmp->delete();
	    	return redirect()->route('tasks')->with('status', 'Модуль удален!');
	    }
	    return redirect()->route('tasks')->with('status', 'Ошибка!');
    }

    public function create(Request $request)
    {
    	$name = $request->input('name');
    	if(!Module::find($name)){
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
