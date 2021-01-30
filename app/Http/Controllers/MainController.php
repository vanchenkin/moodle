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
				return view('student');
			elseif($role == 'TEACHER')
				return view('teacher');
			elseif($role == 'ADMIN')
				return view('admin');
			elseif($role == 'SYSTEM')
				return view('system');
		}
		return view('index');
	}
}
