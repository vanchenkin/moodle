@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    @if(Auth::user()->role == "TEACHER")
                        Панель учителя
                    @elseif(Auth::user()->role == "SYSTEM")
                        Панель администратора сайта
                    @endif
                </div>
                <div class="card-body">
                    <a class="link" href="{{route('tasks')}}">Управление заданиями</a>
                    <a class="link" href="{{route('groups')}}">Управление группами</a>
                    <a class="link" href="{{route('tests')}}">Управление тестами</a>
                    @if(Auth::user()->role == "SYSTEM")
                        <a class="link" href="{{route('users')}}">Список пользователей</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection