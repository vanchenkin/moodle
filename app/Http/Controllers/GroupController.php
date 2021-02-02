<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Group;

class GroupController extends Controller
{
	public function index()
	{
		$groups = Group::all();
		foreach($groups as $group){
			$group->users = $group->users()->where('role', 'STUDENT')->get();
			$group->admins = $group->users()->where('role', 'TEACHER')->get();
		}
		return view('pages.groups', ['groups' => $groups]);
	}
}
