@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Создание теста для группы {{ $group->name }}</div>
                <div class="card-body">
                   <form action="{{ route('test_add', $group) }}" method="GET">
                        <div class="div-input"><label for="name">Название: </label><input required id="name" name="name" type="text" placeholder="Название"></div>
                        <div class="div-input"><label for="start">Время начала: </label><input required id="start" type="datetime-local" name="start" value="{{ Carbon\Carbon::now()->format("Y-m-d\Th:m") }}"></div>
                        <div class="div-input"><label for="end">Время окончания: </label><input required id="end" type="datetime-local" name="end" value="{{ Carbon\Carbon::now()->format("Y-m-d\Th:m") }}"></div>
                        <div class="div-input"><label for="duration">Продолжительность в минутах: </label><input required id="duration" name="duration" type="text" placeholder="Продолжительность"></div>
                        <div class="div-input">Модули:</div>
                        @foreach($modules as $module)
                            <div class="div-input">
                                <input class="checkbox" id="modules-{{$module->id}}" type="checkbox" name="modules[]" value="{{$module->id}}">
                                <label for="modules-{{$module->id}}">{{$module->name}}</label>
                                <input name="count[{{$module->id}}]" type="text" placeholder="Количество вопросов"> из {{$module->count}}
                            </div>
                        @endforeach
                        <input type="submit" value="Добавить">
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
