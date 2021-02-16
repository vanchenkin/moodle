<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Group;
use App\User;

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

	public function create()
    {
        return view('pages.create_group');
    }

	public function add(Request $request)
    {
    	$name = $request->input('name');
    	if(strlen($name)){
    		Group::create(['name' => $name]);
    		return redirect()->route('groups')->with('status', 'Группа успешно добавлена!');
    	}else{
    		return redirect()->route('groups')->with('status', 'Пустое имя!');
    	}
    }

    public function update(Group $group)
    {
        return view('pages.update_group', ['group' => $group, 'users' => User::where('role', 'STUDENT')->get(), 'teachers' => User::where('role', 'TEACHER')->get()]);
    }

    public function change(Request $request, Group $group)
    {
        $gu = $group->users;
        $users = User::find($request->input('users'));
        foreach($gu as $user){
            if($users == null || !$users->find($user)){
                $user->groups()->detach($group);
            }
        }
        if($users)
            foreach($users as $user){
                if(!$gu->find($user))
                    $user->groups()->attach($group);
            }
        return redirect()->route('groups')->with('status', 'Группа успешно изменена!');
    }

    public function delete(Request $request, Group $group){
        $group->delete();
        return redirect()->route('users')->with('status', 'Группа удалена!');
    }
}
