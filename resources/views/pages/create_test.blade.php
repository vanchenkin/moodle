@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Создание теста для группы {{ $group->name }}</div>
                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                   <form action="{{ route('test_add', $group) }}" method="POST">
                    @csrf
                        <div class="div-input"><label for="name">Название: </label><input required id="name" name="name" type="text" placeholder="Название"></div>
                        <div class="div-input"><label for="start">Время начала: </label><input required id="start" type="datetime-local" name="start" value="{{ Carbon\Carbon::now()->format("Y-m-d\TH:i") }}"></div>
                        <div class="div-input"><label for="end">Время окончания: </label><input required id="end" type="datetime-local" name="end" value="{{ Carbon\Carbon::now()->format("Y-m-d\TH:i") }}"></div>
                        <div class="div-input"><label for="duration">Продолжительность в минутах: </label><input required id="duration" name="duration" type="text" placeholder="Продолжительность"></div>
                        <div class="div-input">
                            <input class="checkbox" id="fast_result" type="checkbox" name="fast_result">
                            <label for="fast_result">Результат сразу после завершения</label>
                        </div>
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
