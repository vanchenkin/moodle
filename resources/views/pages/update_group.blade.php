@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Управление участниками группы {{ $group->name }}</div>

                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                   <form action="{{ route('group_change', $group->id) }}" method="POST">
                    @csrf
                        Ученики:
                        @foreach($users as $user)
                            <div class="div-input">
                                <input class="checkbox" id="users-{{$user->id}}" type="checkbox" name="users[]" value="{{$user->id}}" @if($user->groups()->find($group)) checked  @endif>
                                <label for="users-{{$user->id}}">{{$user->name}} {{$user->username}}</label>
                            </div>
                        @endforeach
                        Преподаватели:
                        @foreach($teachers as $user)
                            <div class="div-input">
                                <input class="checkbox" id="users-{{$user->id}}" type="checkbox" name="users[]" value="{{$user->id}}" @if($user->groups()->find($group)) checked  @endif>
                                <label for="users-{{$user->id}}">{{$user->name}} {{$user->username}}</label>
                            </div>
                        @endforeach
                        <div class="div-input"><input type="submit" value="Обновить"></div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
