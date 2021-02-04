@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Списки групп</div>
                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                    @if(Auth::user()->role == "SYSTEM")
                        <a class="link" href="{{route('group_create')}}">Добавить группу</a>
                    @endif
                    @foreach($groups as $group)
                        <div class="card pdd">
                            <div class="card-header">Группа {{$group->name}}</div>

                            <div class="card-body">
                                <a class="link" href="{{route('group_update', $group->id)}}">Добавить/удалить участников</a>
                                <div>Ученики:</div>
                                @foreach($group->users as $id=>$user)
                                    <div class="group-user">{{$id+1}}. {{$user->name}} {{$user->username}}</div>
                                @endforeach
                                <div>Преподаватели:</div>
                                @foreach($group->admins as $id=>$user)
                                    <div class="group-user">{{$user->name}} {{$user->username}}</div>
                                @endforeach
                                <a class="link red" href="{{route('group_delete', $group->id)}}">Удалить группу</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
