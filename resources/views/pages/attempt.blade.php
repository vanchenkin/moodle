@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Просмотр попытки пользователя {{ $user->name }} для теста {{ $test->name }}</div>
                <div class="card-body">
                	@if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                    <div class="">Время начала: {{ $attempt->start }}</div>
                    <div class="">Время окончания: {{ $attempt->end }}</div>
                    <div class="">Результаты:</div>
                    <div>Результат: {{ $sum }} из {{ $count }}</div>
                    @foreach($tasks as $task)
                        <div class="task">
                            <div class="pre">{{ $task->text }}</div>
                            <div>Ответ: {{ $task->yanswer }}</div>
                            <div>Правильный ответ: {{ $task->answer }}</div>
                            <div>Оценка: {{ $task->mark }} из 1</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
