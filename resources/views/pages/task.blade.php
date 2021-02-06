@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Просмотр задания</div>
                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                   <form>
                        @csrf
                        <div><label for="text">Текст задания: </label></div>
                        <div class="task-textarea">
                            <textarea class="" id="text" name="text" disabled>{{ $task->text }}</textarea>
                        <div>
                        <label for="answer">Ответ: </label><input required class="task-answer" id="answer" name="answer" type="text" value="{{ $task->answer }}" disabled>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
