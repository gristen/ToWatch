@extends("components.app")

@section("content")
    <div class="container py-4">
        <h2 class="fw-bold mb-4 text-light">🎬 Каталог фильмов</h2>


            @livewire('movie.movie-list')

        <div class="mt-4">

        </div>
    </div>
@endsection
