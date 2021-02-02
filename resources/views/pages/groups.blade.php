@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Списки групп</div>

                <div class="card-body">
                    @if(Auth::user()->role != "TEACHER")
                        <a class="link" href="{{route('edit_groups')}}">Добавить группу</a>
                    @endif
                    @foreach($groups as $group)
                        <div class="card">
                            <div class="card-header">Группа {{$group->name}}</div>

                            <div class="card-body">
                                <div>Ученики:</div>
                                @foreach($group->users as $id=>$user)
                                    <div class="group-user">{{$id+1}}. {{$user->name}} {{$user->surname}} {{$user->username}}</div>
                                @endforeach
                                <div>Преподаватели:</div>
                                @foreach($group->admins as $id=>$user)
                                    <div class="group-user">{{$user->name}} {{$user->surname}} {{$user->username}}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
