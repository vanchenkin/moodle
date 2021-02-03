@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Добавление задания в модуль {{ $module->name }}</div>

                <div class="card-body">
                   <form action="{{ route('task_add', $module) }}" method="POST">
                        @csrf
                        <div><label for="text">Текст задания: </label></div>
                        <div class="task-textarea">
                            <textarea class="" id="text" name="text" placeholder="Введите текст задания" required></textarea>
                        <div>
                        <label for="answer">Ответ: </label><input required class="task-answer" id="answer" name="answer" type="text" placeholder="Введите ответ на задание">
                        <input type="submit" value="Добавить">
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
