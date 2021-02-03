@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Тестирование</div>

                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                    @foreach($groups as $group)
                        <div class="card pdd">
                            <div class="card-header">Группа {{$group->name}}</div>
                            @if(Auth::user()->role != "STUDENT")
                                <a class="link" href="{{route('test_create', $group)}}">Добавить тест</a>
                            @endif
                            <div class="card-body">
                                <div>Тесты:</div>
                                @foreach($group->tests as $id=>$test)
                                    <a style="display: block;" class="group-test" href="{{route('test', $test)}}">{{$test->name}} Статус: {{ $test->status }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
