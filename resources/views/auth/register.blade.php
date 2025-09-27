@extends('components.app')


@section('content')

<main>
    <div class="container">
        <h3 class="mt-3">Регистрация</h3>
        <hr>
    </div>
    <div class="container d-flex justify-content-center">

        <form action="{{route('register')}}" method="POST" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
            @csrf
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input name="email" type="email" class="form-control" id="email" placeholder="email">
                        <label for="email">E-mail</label>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input name="name" type="text" class="form-control" id="name" placeholder="username">
                        <label for="name">Имя пользователя</label>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input name="password" type="password" class="form-control" id="password" placeholder="*********">
                        <label for="password">Пароль</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating">
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="*********">
                        <label for="password_confirmation">Подтверждение пароля</label>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <button class="btn btn-success text-">Создать аккаунт</button>
            </div>
        </form>
    </div>
</main>

@endsection

