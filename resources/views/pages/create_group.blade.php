@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Добавление группы</div>

                <div class="card-body">
                   <form action="{{ route('group_add') }}" method="POST">
                    @csrf
                        <label for="name">Имя группы: </label><input required id="name" name="name" type="text" placeholder="Введите название">
                        <input type="submit" value="Добавить">
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
