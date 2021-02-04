@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Тест {{ $test->name }} для группы {{ $test->group->name }}</div>
                <div class="card-body">
                	@if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                    <div class="">Время начала: {{ $test->start }}</div>
                    <div class="">Время окончания: {{ $test->end }}</div>
                    <div class="">Продолжительность: {{ $test->duration }} минут</div>
                    <div class="">Количество вопросов: {{ $count }}</div>
                    <div class="">Результаты:</div>
                    @foreach($users as $user)
                        <div class="user">{{ $user->name }} {{ $user->username }} Результат:
                            @if($user->mark == -1)
                            	не писал
                            @else
    							{{ $user->mark }} из {{ $count }}
                                <a class="" href="{{ route('attempt', ['test' => $test->id, 'user' => $user->id]) }}">Просмотр</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
