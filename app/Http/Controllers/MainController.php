<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
	public function index()
	{
		if(Auth::check()){
			$role = Auth::user()->role;
			if($role == 'STUDENT')
				return redirect()->route('tests');
			elseif($role == 'ADMIN')
				return view('admin');
			else
				return view('system');
		}
		return view('index');
	}

	public function denied()
	{
		return view('denied');
	}
}
