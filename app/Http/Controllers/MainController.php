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
			else
				return view('admin');
		}
		return view('index');
	}
}
