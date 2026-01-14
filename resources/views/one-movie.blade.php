@extends('components.app')

@section('content')

    <div class="one-movie__hero full-width"
         style="background: url({{ $movie->preview_url }}) no-repeat right -20px top 0; background-size: 40%;">
        <div class="container h-100 d-flex align-items-center" style="min-height: 400px;">
            <div class="one-movie__content text-white" style="max-width: 700px;">

                <h1 class="mb-3">{{ $movie->name }} <small class="text-muted fs-5">({{ $movie->year }})</small></h1>

                <div class=" movie_tags mb-3">
                    <span class="badge bg-success text-uppercase fs-6">{{ $movie->type }}</span>
                    <span class="badge bg-info fs-6  ms-2">{{ $movie->movieLength }} мин</span>
                    <span class="badge bg-danger fs-6  ms-2">+{{ $movie->age_rating }}</span>
                </div>


                <p class="mb-4" style="line-height: 1.4;">{{ $movie->shortDescription }}</p>

                <div class="mb-3">
                    @if(!$movie->ratings)
                        <strong>Оценка пользователей нашего сайта:</strong>
                        <span
                            class="badge bg-success fs-5 ms-2">{{ number_format($movie->ratings->avg('user_rating'), 1) }}</span>
                    @endif
                </div>

                <div class="d-flex gap-3 flex-wrap mb-4">
                    <div>
                        <strong>КиноПоиск:</strong>
                        <span class="badge bg-warning text-dark ms-1">{{ $movie->kp_rating }}</span>
                    </div>

                    <div>
                        <strong>IMDb:</strong>
                        <span class="badge bg-warning text-dark ms-1">{{ $movie->imdb_rating }}</span>
                    </div>

                    @if($movie->film_critics_rating !== "0.00")
                        <div>
                            <strong>Рейтинг критиков:</strong>
                            <span class="badge bg-warning text-dark ms-1">{{ $movie->film_critics_rating ?? "—"  }}</span>
                        </div>
                    @endif
                </div>

                <div>
                        <strong>Описание:</strong>
                        <p style="line-height: 1.4;">{{ $movie->description ?? "—" }}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="container vh-100">
        <div class="row">
            <div class="movie_info d-flex mt-5 ">
                <div class="col-md-5">
                    <div class="film_img text-white-50">
                        <img style="width: 400px" src="{{$movie->preview_url ?? "—"}}" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="film_info text-white-50">
                        <h4 class="color-white mb-3">О фильме:</h4>

                        <p class=""> <i class="bi bi-film  me-1"></i>Название <span class="text-success">{{$movie->name ?? "—"}}</span></p>
                        <p>  <i class="bi bi-calendar-event  me-1"></i> Год произодства <span class="text-success">{{$movie->year ?? "—"}}</span></p>
                        <p> <i class="bi bi-cast"></i> Жанры:
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($movie->genres as $genre)
                                <span class="badge rounded-pill genre-pill ">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                        </p>

                        <p> <i class="bi bi-translate"></i> Название на английском <span class="text-success">{{$movie->eng_name ?? "—"}}</span></p>
                        <p> <i class="bi bi-card-text"></i> Описание <span class="text-success">{{$movie->discription ?? "—" }}</span></p>
                        <p> <i class="bi bi-camera-reels"></i>
                             Режиссеры:
                            @forelse($movie->directors as $director)
                                <a class="text-decoration-none" href="#">
                        <span class="d-inline-block text-success"
                              tabindex="0"
                              data-bs-toggle="popover"
                              data-bs-trigger="hover focus"
                              data-bs-html="true"
                              data-bs-content="<img src='{{ $director->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $director->name }}</div>">
                            {{ $director->name }}@if(!$loop->last),@endif
                        </span>
                                </a>
                            @empty
                                <span class="text-muted text-success">—</span>
                            @endforelse
                        </p>

                        <p> <i class="bi bi-brush"></i> Художники:
                            @forelse($movie->artists as $artist)
                                <a class="text-decoration-none" href="#">
                                    <span class="d-inline-block text-success"
                                          tabindex="0"
                                          data-bs-toggle="popover"
                                          data-bs-trigger="hover focus"
                                          data-bs-html="true"
                                          data-bs-content="<img src='{{ $artist->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $artist->name }}</div>">
                                        {{ $artist->name }}@if(!$loop->last),@endif
                                    </span>
                                </a>
                            @empty
                                <span class="text-success">—</span>
                            @endforelse
                        </p>
                        <p> <i class="bi bi-alarm"></i> Время: <span class="text-success">{{$movie->movieLength ?? "—"}}</span> мин.</p>
                    </div>
                </div>
                {{-- ACTORS + SERVICES --}}
                <div class="col-md-3">

                    <h6 class="text-white mb-2">Актёры</h6>

                    <div class="d-flex flex-wrap gap-1 mb-2">
                        @foreach($actors->take($limit) as $actor)
                            <span class="actor-chip">{{ $actor->name }}</span>
                        @endforeach
                    </div>

                    @if($hasMore)
                        <a class="badge bg-success text-decoration-none"
                           data-bs-toggle="collapse"
                           href="#actorsCollapse">
                            + {{ $moreCount }}
                        </a>

                        <div class="collapse mt-2" id="actorsCollapse">
                            <div class="card card-body bg-dark border-black shadow-lg">
                                @foreach($actors->slice($limit) as $actor)
                                    <span class="actor-chip mb-1">{{ $actor->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>

@endsection
