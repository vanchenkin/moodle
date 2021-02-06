@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Редактирование задания</div>
                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                   <form action="{{ route('task_change', $task) }}" method="POST">
                        @csrf
                        <div><label for="text">Текст задания: </label></div>
                        <div class="task-textarea">
                            <textarea class="" id="text" name="text" placeholder="Введите текст задания" required>{{ $task->text }}</textarea>
                        <div>
                        <label for="answer">Ответ: </label><input required class="task-answer" id="answer" name="answer" type="text" placeholder="Введите ответ на задание" value="{{ $task->answer }}">
                        <input type="submit" value="Изменить">
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
