@extends('components.app')

@section('content')
    <main>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 85vh;">

            <div class="auth-card text-white p-5 w-100" style="max-width: 480px;">
                <h2 class="text-center mb-4 fw-bold">Создание аккаунта</h2>

                <form action="{{ route('register') }}" method="POST" class="d-flex flex-column gap-3">
                    @csrf

                    <div>
                        <label class="form-label">E-mail</label>
                        <input name="email" type="email" class="form-control auth-input" placeholder="example@mail.com" required>
                    </div>

                    <div>
                        <label class="form-label">Имя пользователя</label>
                        <input name="name" type="text" class="form-control auth-input" placeholder="Ваш никнейм" required>
                    </div>

                    <div class="row g-3">
                        <div class="col">
                            <label class="form-label">Пароль</label>
                            <input name="password" type="password" class="form-control auth-input" placeholder="••••••••" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Повторите пароль</label>
                            <input name="password_confirmation" type="password" class="form-control auth-input" placeholder="••••••••" required>
                        </div>
                    </div>

                    <button class="btn auth-btn w-100 fw-bold mt-3">Создать аккаунт</button>
                </form>

                <p class="text-center mt-4 opacity-75">
                    Уже есть аккаунт?
                    <a href="{{route('login')}}" class="reg-link">Войти →</a>
                </p>
            </div>
        </div>
    </main>

@endsection
