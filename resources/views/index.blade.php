@extends("components.app")

@section("content")

    <div class="container py-4">

        @if(Auth::check() && Auth::user()->role_id<3)
            <p class="alert alert-danger text-center"> <i class="bi bi-exclamation-triangle"></i> Ты зашел с расширенными правами доступа. Уровень доступа - {{Auth::user()->role->name}} <i class="bi bi-exclamation-triangle"></i></p>
        @endif
        <h2 class="fw-bold mb-4 text-light">🎬 Каталог фильмов</h2>


            @livewire('movie.movie-list')

        <div class="mt-4">

        </div>
    </div>
@endsection
