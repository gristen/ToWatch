@extends('components.app')



@section('content')


    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class=" modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование профиля</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                   <p class="text-danger"> Тут будет редактирование профиля...позже</p>
                    <form action="#" method="#">
                        <input name  disabled class="form-control input-group" placeholder="какой-то текст">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-4 profile">

    <div class="profile-header d-flex align-items-center mb-4">
        <img src="{{ asset('assets/' . $user->avatar) }}"
        class="rounded-circle me-3 profile-avatar"
             width="100" height="100" alt="avatar">
        <div>
            <h3 class="text-white">{{$user->name}}</h3>
            <p class="text m-0">{{$user->email}}</p>
            <div class="d-flex gap-3">
                <a class="text-white" href="#"><span><strong>{{$user->followers_count}}</strong> подписчиков</span></a>
                <a class="text-white" href="#"><span><strong>{{$user->following_count}}</strong> подписки</span></a>
            </div>
        </div>
        <div class="ms-auto">
        @auth
                @if(auth()->id() !== $user->id)
                    <form action="{{ route('users.follow', $user) }}" method="POST">
                        @csrf
                        <button class="btn
                            {{ auth()->user()->isFollowing($user) ? 'btn-secondary' : 'btn-success' }}">

                            {{ auth()->user()->isFollowing($user) ? 'Отписаться' : 'Подписаться' }}
                        </button>
                    </form>
                @else
                    <!-- Кнопка-триггер модального окна -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Редактировать профиль
                    </button>

                @endif
            @endauth

        </div>
    </div>

    <div class="row mb-4">

        <div class="col-md-6">
            <h5>О себе</h5>
            <p class="profile-bio">
                Люблю смотреть драмы и фантастику. Иногда пишу рецензии на редкие фильмы.
                Моя цель — посмотреть 500 фильмов в этом году 🎬
            </p>
        </div>

        <div class="col-md-6">
            <h5>Любимые жанры</h5>
            <div>
                <span class="badge rounded-pill genre-pill">Фантастика</span>
                <span class="badge rounded-pill genre-pill">Драма</span>
                <span class="badge rounded-pill genre-pill">Триллер</span>
                <span class="badge rounded-pill genre-pill">Комедия</span>
            </div>
        </div>
    </div>


    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="stats-box">
                <h4>{{$user->viewed_movies_count}}</h4>
                <p>Фильмов посмотрено</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-box">
                <h4>{{$user->favorites_movies_count}}</h4>
                <p>Отзывов</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-box">
                <h4>{{$user->likes_movies_count}}</h4>
                <p>Понравившиеся</p>
            </div>
        </div>
    </div>


    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#favorites">Избранные</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#liked">Лайки</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#reviews">Отзывы</a>
        </li>
    </ul>


    <div class="tab-content">

        <div class="tab-pane fade show active" id="favorites">
            <div class="row">
                @foreach($user->favoritesMovies as $movie)
                  <x-movie.card :movie="$movie" mode="favorite" />
                @endforeach
            </div>
        </div>

        <!-- Лайки -->
        <div class="tab-pane fade" id="liked">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card movie-card h-100">
                        <img src="https://placehold.co/600x400" class="card-img-top" alt="poster">
                        <div class="card-body">
                            <h6 class="card-title text-white">Лайкнутый фильм</h6>
                            <span class="badge">⭐ 9.0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Рецензии -->
        <div class="tab-pane fade" id="reviews">
            <div class="card mb-3 bg-dark text-white">
                <div class="card-body">
                    <h5>Фильм 1</h5>
                    <p>Очень понравился фильм! Классная режиссура и игра актеров.</p>
                    <small class="text-muted">Оценка: 9/10</small>
                </div>
            </div>
            <div class="card mb-3 bg-dark text-white">
                <div class="card-body">
                    <h5>Фильм 2</h5>
                    <p>Сюжет затянутый, но картинка шикарная.</p>
                    <small class="text-muted">Оценка: 6/10</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
