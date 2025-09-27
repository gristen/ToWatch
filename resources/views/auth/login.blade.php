@extends('components.app')

@section('content')
<div class="form-signin w-100 m-auto">
    <form method="POST" action="{{route('login')}}">
        @csrf
        <div class="d-flex" style="align-items: center; justify-content: space-between">
            <h2>Вход</h2>
        </div>
        <div class="form-floating mt-3">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="email@mail.ru"> <label for="floatingInput">E-mail</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Пароль"> <label for="floatingPassword">Пароль</label>
        </div>
        <button class="btn btn-success w-100 py-2" type="submit">Войти</button>
    </form>
</div>

@endsection
