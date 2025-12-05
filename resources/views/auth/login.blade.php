@extends('components.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="auth-card text-white p-5">

            <h2 class="text-center mb-4 fw-bold">Вход</h2>

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control auth-input" placeholder="example@mail.com">
            </div>

            <div class="mb-4">
                <label class="form-label">Пароль</label>
                <input type="password" class="form-control auth-input" placeholder="Введите пароль">
            </div>

            <button class="btn auth-btn w-100 fw-bold">Войти</button>

            <p class="text-center mt-3 opacity-75">
                Нет аккаунта? <a href="{{route('register')}}" class="reg-link">Создать →</a>
            </p>
        </div>
    </div>


@endsection
