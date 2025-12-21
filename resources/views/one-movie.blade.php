@extends('components.app')

@section('content')


    <div class="one-movie__hero full-width" style="background: url({{ $movie->preview_url }}) no-repeat right -20px top 0; background-size: 40%;">
        <div class="container h-100 d-flex align-items-center" style="min-height: 400px;">
            <div class="one-movie__content text-white" style="max-width: 700px;">

                <h1 class="mb-3">{{ $movie->name }} <small class="text-muted fs-5">({{ $movie->year }})</small></h1>

                <div class="mb-3">
                    <span class="badge bg-success text-uppercase fs-6">{{ $movie->type }}</span>
                    <span class="badge bg-info ms-2">{{ $movie->movieLength }} мин</span>
                    <span class="badge bg-danger ms-2">+{{ $movie->age_rating }}</span>
                </div>

                <p class="mb-4" style="line-height: 1.4;">{{ $movie->shortDescription }}</p>

                <div class="mb-3">
                    <strong>Оценка пользователей нашего сайта:</strong>
                    <span class="badge bg-success fs-5 ms-2">{{ number_format($movie->ratings->avg('user_rating'), 1) }}</span>
                </div>

                <div class="d-flex gap-3 flex-wrap mb-4">
                    <div>
                        <strong>КиноПоиск:</strong>
                        <span class="badge bg-warning text-dark ms-1">{{ $movie->kp_rating }}</span>
                        <a href="https://www.kinopoisk.ru/film/{{ $movie->kinopoisk_id }}" target="_blank" class="ms-1 text-decoration-none text-warning" title="Перейти на КиноПоиск">
                            🔗
                        </a>
                    </div>

                    <div>
                        <strong>IMDb:</strong>
                        <span class="badge bg-warning text-dark ms-1">{{ $movie->imdb_rating }}</span>
                        <a href="https://www.imdb.com/title/{{ $movie->imdb_id }}" target="_blank" class="ms-1 text-decoration-none text-warning" title="Перейти на IMDb">
                            🔗
                        </a>
                    </div>

                    <div>
                        <strong>Рейтинг критиков:</strong>
                        <span class="badge bg-warning text-dark ms-1">{{ $movie->film_critics_rating }}</span>
                    </div>
                </div>

                <div>
                    <strong>Описание:</strong>
                    <p style="line-height: 1.4;">{{ $movie->description }}</p>
                </div>

            </div>


        </div>

    </div>
  {{--  <div class="movie_info mt-5 ">
        <p class="text-white">123</p>
    </div>--}}
@endsection
