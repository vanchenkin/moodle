<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
	public function index()
	{
		$groups = Auth::user()->groups;
		foreach($groups as $group){
			$group->users = $group->users()->where('role', 'STUDENT')->get();
		}
		return view('pages.groups', ['groups' => $groups]);
	}
}
