@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Добавление модуля</div>

                <div class="card-body">
                   <form action="{{ route('module_add') }}" method="GET">
                        <label for="name">Имя модуля: </label><input name="name" type="text" placeholder="Введите название">
                        <input type="submit" value="Добавить">
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
