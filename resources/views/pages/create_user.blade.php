@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Добавление нового пользователя</div>

                <div class="card-body">
                    @if(Session::has('status'))
                        <div class="alert alert-info">
                            {{ Session::get('status')}}
                        </div>
                    @endif
                   <form action="{{ route('user_add') }}" method="POST">
                    @csrf
                        <div class="div-input"><label for="name">ФИО: </label><input required id="name" name="name" type="text" placeholder="Введите ФИО"></div>
                        <div class="div-input"><label for="username">Логин: </label><input required id="username" name="username" type="text" placeholder="Введите логин"></div>
                        <div class="div-input"><label for="password">Пароль: </label><input required id="password" name="password" type="text" placeholder="Введите пароль"></div>
                        Роль:
                        <div class="div-input"><input id="STUDENT" name="role" type="radio" value="STUDENT" required><label for="STUDENT">Студент</label></div>
                        <div class="div-input"><input id="TEACHER" name="role" type="radio" value="TEACHER" required><label for="TEACHER">Учитель</label></div>
                        <div class="div-input"><input id="ADMIN" name="role" type="radio" value="ADMIN" required><label for="ADMIN">Администратор учебного процесса</label></div>
                        <div class="div-input"><input id="SYSTEM" name="role" type="radio" value="SYSTEM" required><label for="SYSTEM">Администратор сайта</label></div>
                        <input type="submit" value="Добавить">
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
