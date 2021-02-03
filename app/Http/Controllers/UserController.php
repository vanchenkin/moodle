<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;

class UserController extends Controller
{
	public function index()
	{
		return view('pages.users', ['users' => User::all()]);
	}

	public function create()
    {
        return view('pages.create_user');
    }

    public function add(Request $request)
    {
    	$validator = Validator::make($request->all(),
		    [
		        'name' => 'required',
		        'username' => 'required',
		        'password' => 'required|min:8',
		        'role' => 'required',
		    ]
		);
		if ($validator->fails())
		    return redirect()->route('user_create')->with('status', $validator->errors());
    	$name = $request->input('name');
    	$username = $request->input('username');
    	$password = $request->input('password');
    	$role = $request->input('role');
    	if(!User::where('username', $username)->count()){
    		User::create(['name' => $name, 'username' => $username, 'password' => Hash::make($password), 'role' => $role]);
    		return redirect()->route('users')->with('status', 'Пользователь успешно добавлен!');
    	}else{
    		return redirect()->route('user_create')->with('status', 'Пользователь с таким логином уже существует!');
    	}
    }
}
