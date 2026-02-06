
    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
        <div class="movie-tile">

            <img
                src="{{ $movie->preview_url ?? asset('poster.jpg') }}"
                alt="{{ $movie->name }}"
            >

            <span class="movie-type">
                        {{ strtoupper($movie->type ?? 'movie') }}
                    </span>
            <span class="movie-rating">
                        {{ strtoupper($movie->imdb_rating ?? 'movie') }}
                    </span>

            <div class="movie-hover">
                <div class="movie-title">
                    {{ $movie->name }}
                </div>

                <div class="movie-meta">
                    {{ $movie->year ?? '—' }}
                </div>

                <a href="{{route('movie.show', [$movie, $movie->slug])}}" class="btn btn-success btn-sm w-100 mt-2">
                    Смотреть
                </a>

                @if(Auth::check() && Auth::user()->role->id  < 3 && $mode !== "favorite" ) // 3 = user
                    <button
                        class="btn btn-danger btn-sm w-100 mt-1"
                        data-bs-toggle="modal"
                        data-bs-target="#closeModal"
                        wire:click="$dispatch('set-movie-id', { id: {{ $movie->id }} })"
                    >
                        Удалить
                    </button>
                @else
                    {{--Удалить из избранного--}}
                    <button
                        class="btn btn-danger btn-sm w-100 mt-1"
                        data-bs-toggle="modal"
                        data-bs-target="#closeModal"
                        wire:click="$dispatch('set-movie-id', { id: {{ $movie->id }} })"
                    >
                        Удалить*
                    </button>
                @endif
            </div>

        </div>
    </div>

