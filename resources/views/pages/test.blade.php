@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Тест {{ $test->name }}</div>
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
                    @if($status == 0)
                    	<div>Тестирование ещё не началось.</div>
                    @elseif($status == 1)
                    	<a class="link" href="{{ route('test_start', $test->id) }}">Начать</a>
                    @elseif($status == 2)
                    	<div class="">Осталось: <span id="remain" remain="{{ $remain }}"></span></div>
                    	<form id="test-form" action="{{ route('test_end', $attempt) }}" method="POST">
                    		@csrf
	                    	@foreach($tasks as $task)
	                    		<div class="task">
	                    			<div class="pre">{{ $task->text }}</div>
	                    			<input type="text" name="answers[{{ $task->id }}]" placeholder="Ответ">
	                    		</div>
	                    	@endforeach
	                    	<input type="submit" value="Завершить">
	                    	<div>Тест автоматически завершится по истечении времени. Ответы не сохраняются</div>
	                    </form>
                    @elseif($status == 3)
                    	<div>Для просмотра результатов дождитесь окончания тестирования.</div>
                    @elseif($status == 4)
                    	<div>Результат: {{ $sum }} из {{ $count }}</div>
                    	@foreach($tasks as $task)
                    		<div class="task">
                    			<div class="pre">{{ $task->text }}</div>
                    			<div>Ответ: {{ $task->yanswer }}</div>
                    			<div>Правильный ответ: {{ $task->answer }}</div>
                    			<div>Оценка: {{ $task->mark }} из 1</div>
                    		</div>
                    	@endforeach
                    @elseif($status == 5)
                    	<div>Тестирование завершено. Вы его не писали</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
