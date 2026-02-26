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
                      @if(!empty($movie->age_rating))
                            <span class="badge bg-danger fs-6  ms-2">+{{ $movie->age_rating }}</span>
                      @endif
                </div>


                <p class="mb-4" style="line-height: 1.4;">{{ $movie->description }}</p>

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
                            <span
                                class="badge bg-warning text-dark ms-1">{{ $movie->film_critics_rating ?? "—"  }}</span>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>


    <div class="container vh-100">
        <div class="row">
            <div class="movie_info d-flex mt-5 ">
                <div class="col-md-4 ">
                    <div class="film_img position-relative">
                        <img src="{{ $movie->preview_url }}" class="img-fluid rounded">
                    </div>

                    @auth
                        <div class="film_actions ">
                            <form class=" film_form_actions d-flex justify-content-center" id="favorite-form" method="POST">
                                @csrf
                                <button
                                    type="button"
                                    data-action="viewed"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    data-url="{{ route('movie.action', ['id'=>$movie->id]) }}"
                                    title="Просмотрено"
                                    class="btn  mt-2  mx-3

                                    {{auth()->user()->isViewed($movie->id)
                                    ? 'btn-success '
                                    : 'btn-outline-success'
                                    }}">

                                    {!! auth()->user()->isViewed($movie->id)
                                    ? '<i class="bi bi-check2-all"></i>'
                                    : '<i class="bi bi-check2"></i>' !!}
                                </button>
                                <button
                                    id="favorite-btn"
                                    type="button"
                                    data-action="favorite"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    data-url="{{ route('movie.action', ['id'=>$movie->id]) }}"
                                    title="Добавить в избранное"
                                    class="btn  mt-2  mx-3

                                    {{ auth()->user()->isFavorited($movie->id)
                                    ? 'btn-success'
                                    : 'btn-outline-success'
                                    }}">

                                    {!! auth()->user()->isFavorited($movie->id)
                                    ? '<i class="bi bi-bookmark-star"></i>'
                                    : '<i class="bi bi-bookmark-star-fill"></i>' !!}
                                </button>

                                <button
                                    data-action="like"
                                    data-url="{{ route('movie.action', ['id'=>$movie->id]) }}"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    title="Любимые"
                                    class="btn  mt-2  mx-3

                                    {{auth()->user()->isLiked($movie->id)
                                    ? 'btn-success'
                                    : 'btn-outline-success'
                                    }}">

                                    {!! auth()->user()->isLiked($movie->id)
                                    ? '<i class="bi bi-heart"></i>'
                                    : '<i class="bi bi-heart-fill"></i>' !!}
                                </button>

                                <button
                                    data-action="watchLater"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    title="Смотреть позже"
                                    class="btn  mt-2  mx-3

                                    {{auth()->user()->isFavorited($movie->id)
                                    ? 'btn-outline-success'
                                    : 'btn-success'
                                    }}">

                                    {!! auth()->user()->isFavorited($movie->id)
                                    ? '<i class="bi bi-stopwatch"></i>'
                                    : '<i class="bi bi-stopwatch-fill"></i>' !!}
                                </button>



                            </form>
                        </div>
                    @endAuth
                </div>

                <div class="col-md-4 offset-1">
                    <div class="film_info text-white-50">
                        <h4 class="color-white mb-3">О фильме:</h4>

                        <p class=""><i class="bi bi-film  me-1"></i>Название <span
                                class="text-success">{{$movie->name ?? "—"}}</span></p>
                        <p><i class="bi bi-calendar-event  me-1"></i> Год произодства <span
                                class="text-success">{{$movie->year ?? "—"}}</span></p>
                        <p><i class="bi bi-cast"></i> Жанры:
                        <div class="d-flex flex-wrap gap-1">
                            @foreach($movie->genres as $genre)
                                <span class="badge rounded-pill genre-pill cursor-pointer ">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                        </p>
                        <p><i class="bi bi-translate"></i> Название на английском <span
                                class="text-success">{{$movie->eng_name ?? "—"}}</span></p>
                        <p><i class="bi bi-camera-reels"></i>
                            Режиссеры:
                            @forelse($movie->directors as $director)
                                <a class="text-decoration-none" href="#">
                        <span class="d-inline-block text-success"
                              tabindex="0"
                              data-bs-toggle="popover"
                              data-bs-trigger="hover focus"
                              data-bs-html="true"
                              data-bs-content="<img src='{{ $director->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $director->name }}</div>">
                            {{ $director->name }}@if(!$loop->last)
                                ,
                            @endif
                        </span>
                                </a>
                            @empty
                                <span class="text-muted text-success">—</span>
                            @endforelse
                        </p>

                        <p><i class="bi bi-brush"></i> Художники:
                            @forelse($movie->artists as $artist)
                                <a class="text-decoration-none" href="#">
                                    <span class="d-inline-block text-success"
                                          tabindex="0"
                                          data-bs-toggle="popover"
                                          data-bs-trigger="hover focus"
                                          data-bs-html="true"
                                          data-bs-content="<img src='{{ $artist->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $artist->name }}</div>">
                                        {{ $artist->name }}@if(!$loop->last)
                                            ,
                                        @endif
                                    </span>
                                </a>
                            @empty
                                <span class="text-success">—</span>
                            @endforelse
                        </p>
                        <p>
                            <i class="bi bi-card-text text-justify "></i> Описание <span
                                class="text-success">{{$movie->description ?? "—" }}</span></p>

                        {{--Информация для администратора--}}
                        <p><i class="bi bi-alarm"></i> Время: <span
                                class="text-success">{{$movie->movieLength ?? "—"}}</span> мин.</p>
                        @if(auth()->check() && auth()->user()->isStaff())
                            <p class="text-danger mt-5">Информация для администратора</p>
                            <span class="text-success ">
                                время добавления в бд -
                                {{$movie->created_at}}
                            </span>
                        @endif


                    </div>
                </div>


                {{-- ACTORS + SERVICES --}}
                <div class="col-md-3">

                    <h6 class="text-white mb-2">Актёры</h6>

                    <div class="d-flex flex-wrap gap-1 mb-2">
                        @foreach($actors->take($limit) as $actor)

                            <span class=" actor-chip d-inline-block text-success cursor-pointer "
                                  tabindex="0"
                                  data-bs-toggle="popover"
                                  data-bs-trigger="hover focus"
                                  data-bs-html="true"
                                  data-bs-content="<img src='{{ $actor->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $actor->name }}</div>">
                                        {{ $actor->name }}@if(!$loop->last)
                                @endif
                                    </span>
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
            <div class="reviews-carousel-container ">
                <div class="reviews-carousel-header d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-dark btn-sm active">Отзывы 7</button>
                        <button class="btn btn-dark btn-sm">Рецензии 2</button>
                    </div>
                    <div class="carousel-nav">
                        <button class="prev">&larr;</button>
                        <button class="next">&rarr;</button>
                    </div>
                </div>

                <div class="reviews-carousel-wrapper">
                    <div class="reviews-carousel">

                        <div class="review-card">
                            <div class="review-author">lapka.alexandrova</div>
                            <div class="review-text">
                                Очень хороший фильм, душевный, с классным юмором, поднимает настроение и сюжет интересный
                            </div>
                            <div class="review-footer">
                                <span class="review-date">25 июня 2020</span>
                                <div class="review-actions">
                                    <span class="like">👍 7</span>
                                    <span class="dislike">👎</span>
                                </div>
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-author">elkelk</div>
                            <div class="review-text">
                                отличный фильм, поднял настроение! здорово, что на французском!
                            </div>
                            <div class="review-footer">
                                <span class="review-date">15 апреля 2020</span>
                                <div class="review-actions">
                                    <span class="like">👍 5</span>
                                    <span class="dislike">👎</span>
                                </div>
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-author">АНЯ</div>
                            <div class="review-text">
                                Посмеялись от души! Рекомендую к просмотру
                            </div>
                            <div class="review-footer">
                                <span class="review-date">13 июля 2020</span>
                                <div class="review-actions">
                                    <span class="like">👍 4</span>
                                    <span class="dislike">👎</span>
                                </div>
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-author">Аккаунт</div>
                            <div class="review-text">
                                Как негритянка родила, если у неё не было живота?
                            </div>
                            <div class="review-footer">
                                <span class="review-date">30 декабря 2020</span>
                                <div class="review-actions">
                                    <span class="like">👍 1</span>
                                    <span class="dislike">👎</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

            <script>
                $(document).ready(function() {
                    /*corousel*/
                    const carousel = document.querySelector('.reviews-carousel');
                    let offset = 0;

                    document.querySelector('.next').addEventListener('click', () => {
                        const maxOffset = carousel.scrollWidth - carousel.parentElement.offsetWidth;
                        offset += 260; // ширина карточки + gap
                        if(offset > maxOffset) offset = maxOffset;
                        carousel.style.transform = `translateX(-${offset}px)`;
                    });

                    document.querySelector('.prev').addEventListener('click', () => {
                        offset -= 260;
                        if(offset < 0) offset = 0;
                        carousel.style.transform = `translateX(-${offset}px)`;
                    });
                    /*отправка формы*/

                    $('#favorite-form button').on('click',function (e) {
                        e.preventDefault();
                        let $btn = $(this)
                        let url = $btn.data('url')
                        let action = $btn.data('action')


                        let tooltipInstance = bootstrap.Tooltip.getInstance($btn[0]);
                        if (tooltipInstance) {
                            tooltipInstance.hide();
                        }
                        console.log($btn[0])
                        $.ajax({
                            url: url,
                            method:'POST',
                            data:{
                                _token: $('input[name="_token"]').val(),
                                'action_type':action
                            },
                            success: function (response) {
                                console.log(response)
                                if (response.status) {
                                    $btn
                                .removeClass('btn-outline-success')
                                        .addClass('btn-success')
                                    toggleIcon($btn, true)
                                }else{
                                    $btn
                                        .removeClass('btn-success')
                                        .addClass('btn-outline-success')
                                    toggleIcon($btn, false)
                                }

                            },
                        })
                    })
                    function toggleIcon($btn, active) {

                        let icons = {
                            favorite: ['bi-bookmark-star', 'bi-bookmark-star-fill',],
                            like: ['bi-heart', 'bi-heart-fill',],
                            viewed:[ 'bi-check2-all', 'bi-check2',],
                            watchLater: ['bi-stopwatch', 'bi-stopwatch-fill',],
                        };

                        let action = $btn.data('action');
                        let icon = active ? icons[action][0] : icons[action][1]

                        $btn.html(`<i class="bi ${icon}"></i>`)
                    }


            });
        </script>

@endsection
