@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Управление заданиями</div>

                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                    <a class="link" href="{{route('create_module')}}">Добавить модуль</a>
                    @foreach($modules as $module)
                        <div class="card pdd">
                            <div class="card-header">Модуль {{$module->name}}</div>
                            <a class="tasks-addtask link" href="{{route('task_create', $module)}}">Добавить задание</a>
                            <div class="card-body">
                                @foreach($module->tasks as $id=>$task)
                                    <div class="tasks-task">
                                        <div class="task-text" style="white-space: nowrap;">{{$id+1 }}. {{ $task->text }} </div>
                                        <a class="tasks-delete red confirm link" href="{{route('task_delete', $task->id)}}">Удалить задание</a>
                                    </div>
                                @endforeach
                            </div>
                            <a class="tasks-addtask red confirm link" href="{{route('module_delete', $module->id)}}">Удалить модуль</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
