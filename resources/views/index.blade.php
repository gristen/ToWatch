@extends("components.app")
@dump($movies)
@section("content")
    <div class="container py-4">
        <h2 class="fw-bold mb-4 text-light">🎬 Каталог фильмов</h2>

        <div class="row g-4">
            @foreach($movies as $movie)
                <div class="col-md-3 col-sm-6">
                    <div class="card movie-card border-0 shadow-sm h-100">
                        <div class="movie-image position-relative">
                            <img
                                    src="{{ $movie->preview_url ?? url('poster.jpg') }}"
                                    class="card-img-top rounded-top"
                                    alt="{{ $movie->name ?? $movie->eng_name }}"
                            >
                            <span class="badge bg-dark position-absolute top-0 end-0 m-2">
                            {{ strtoupper($movie->type ?? 'movie') }}
                        </span>
                        </div>

                        <div class="card-body bg-dark text-white rounded-bottom">
                            <h5 class="card-title mb-1">
                                {{ $movie->name ?? 'Без названия' }}
                            </h5>
                            <p class="text-secondary mb-2">
                                {{ $movie->eng_name ?? '' }}
                            </p>

                            <div class="small text-muted mb-2">
                                <span>{{ $movie->year ?? '—' }}</span> •
                                <span>{{ $movie->movieLength ? $movie->movieLength . ' мин' : '' }}</span>
                            </div>

                            @if($movie->countries && $movie->countries->count())
                                <p class="small text-muted mb-2">
                                    🌍
                                    {{ $movie->countries->pluck('name')->join(', ') }}
                                </p>
                            @endif
                            @if(Auth::check() && Auth::user()->role->id < 3)
                                <p class="small text-muted">
                                    👤 *Опубликовал: <a href="">{{ $movie->publisher->name }}</a>
                                </p>
                            @endif
                            <a href="#"
                               class="btn btn-success w-100 mt-2 fw-bold">
                                Смотреть →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
