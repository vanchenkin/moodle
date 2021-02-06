@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Панель администратора учебного процесса</div>
                <div class="card-body">
                    <a class="link" href="{{route('tasks')}}">Просмотр заданий</a>
                    <a class="link" href="{{route('groups')}}">Просмотр групп</a>
                    <a class="link" href="{{route('tests')}}">Просмотр тестирований</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection