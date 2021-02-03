@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Список пользователей</div>
                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                    <a class="link" href="{{route('user_create')}}">Зарегистрировать пользователя</a>
                    @foreach($users as $user)
                        <div>{{$user->name}} {{$user->username}} {{ $user->role }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
