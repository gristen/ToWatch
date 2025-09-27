@extends('.components.app')



@section('content')

<div class="container mt-4 profile">
    <!-- Шапка профиля -->
    <div class="profile-header d-flex align-items-center mb-4">
        <img src="https://placehold.co/600x400"
             class="rounded-circle me-3 profile-avatar"
             width="100" height="100" alt="avatar">
        <div>
            <h3 class="text-white">{{$user->name}}</h3>
            <p class="text">{{$user->email}}</p>
            <div class="d-flex gap-3">
                <span><strong>123</strong> подписчиков</span>
                <span><strong>45</strong> подписки</span>
            </div>
        </div>
        <div class="ms-auto">
            <button title="в работе" class="btn btn-success disabled">Подписаться</button>
        </div>
    </div>
    <!-- Дополнительная инфа -->
    <div class="row mb-4">
        <!-- О себе -->
        <div class="col-md-6">
            <h5>О себе</h5>
            <p class="profile-bio">
                Люблю смотреть драмы и фантастику. Иногда пишу рецензии на редкие фильмы.
                Моя цель — посмотреть 500 фильмов в этом году 🎬
            </p>
        </div>
        <!-- Любимые жанры -->
        <div class="col-md-6">
            <h5>Любимые жанры</h5>
            <div>
                <span class="genre-badge">Фантастика</span>
                <span class="genre-badge">Драма</span>
                <span class="genre-badge">Триллер</span>
                <span class="genre-badge">Комедия</span>
            </div>
        </div>
    </div>

    <!-- Статистика -->
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="stats-box">
                <h4>248</h4>
                <p>Фильмов посмотрено</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-box">
                <h4>36</h4>
                <p>Рецензий</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-box">
                <h4>7.8</h4>
                <p>Средняя оценка</p>
            </div>
        </div>
    </div>

    <!-- Навигация -->
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#favorites">Избранные</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#liked">Лайки</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#reviews">Рецензии</a>
        </li>
    </ul>

    <!-- Контент вкладок -->
    <div class="tab-content">
        <!-- Избранные -->
        <div class="tab-pane fade show active" id="favorites">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card movie-card h-100">
                        <img src="https://placehold.co/600x400" class="card-img-top" alt="poster">
                        <div class="card-body">
                            <h6 class="card-title text-white">Фильм 1</h6>
                            <span class="badge bg-warning">⭐ 8.1</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card movie-card h-100">
                        <img src="https://placehold.co/600x400" class="card-img-top" alt="poster">
                        <div class="card-body">
                            <h6 class="card-title text-white">Фильм 2</h6>
                            <span class="badge bg-warning">⭐ 7.5</span>
                        </div>
                    </div>
                </div>
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
