@extends('components.admin.app')
@section("content")
    <div class="container-fluid py-4">

        <!-- HEADER -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body d-flex align-items-center gap-4">

                <!-- Avatar -->
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                     style="width: 80px; height: 80px; font-size: 28px;">

                </div>

                <!-- Info -->
                <div class="flex-grow-1">
                    <h4 class="mb-1">{{ $user->name ?? 'Имя пользователя' }}</h4>
                    <div class="text-muted">{{ $user->email ?? 'email@example.com' }}</div>

                    <span class="badge {{$user->role->getBadgeClass()}} mt-2">
                    {{ $user->role->name ?? 'Роль' }}
                </span>
                </div>

                <!-- Actions -->
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit"></i> Редактировать
                    </button>
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-ban"></i> Заблокировать
                    </button>
                </div>

            </div>
        </div>

        <!-- STATS -->
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="text-muted small">Фильмы в избранном</div>
                    <h4 class="mb-0">{{ $user->favorites_count ?? 0 }}</h4>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="text-muted small">Просмотрено</div>
                    <h4 class="mb-0">{{ $user->watched_count ?? 0 }}</h4>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="text-muted small">Комментарии</div>
                    <h4 class="mb-0">{{ $user->comments_count ?? 0 }}</h4>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm text-center p-3">
                    <div class="text-muted small">Рейтинг</div>
                    <h4 class="mb-0">{{ $user->rating ?? 0 }}</h4>
                </div>
            </div>

        </div>

        <!-- DETAILS -->
        <div class="row g-3">

            <!-- LEFT -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-semibold">
                        Основная информация
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <small class="text-muted">ID</small>
                            <div>{{ $user->id ?? '—' }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Имя</small>
                            <div>{{ $user->name ?? '—' }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Email</small>
                            <div>{{ $user->email ?? '—' }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Дата регистрации</small>
                            <div>{{ $user->created_at->format('HH:mm D MMMM YYYY') ?? '—' }}</div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-semibold">
                        Дополнительно
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <small class="text-muted">О пользователе</small>
                            <div>{{ $user->about ?? 'Нет информации' }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Последний вход</small>
                            <div>{{ $user->last_login ?? '—' }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Статус</small>
                            <span class="badge bg-success">Активен</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- ACTIVITY -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white fw-semibold">
                Последние действия
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                        @foreach($activities as $activity)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{$activity->description}}</span>
                            <small class="text-muted">{{$activity->created_at->isoFormat('D MMMM YYYY')}}</small>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

    </div>
@endsection
