@extends('components.app')

@section('content')
    @php
        $siteRating = $movie->ratings?->avg('user_rating');
    @endphp

    <section class="one-movie-hero full-width" style="--movie-backdrop: url({{ $movie->preview_url }});">
        <div class="container one-movie-hero__inner">
            <div class="one-movie-hero__copy">
                <div class="one-movie-kicker">
                    <span>{{ $movie->type }}</span>
                    @if(!empty($movie->year))
                        <span>{{ $movie->year }}</span>
                    @endif
                    @if(!empty($movie->movieLength))
                        <span>{{ $movie->movieLength }} мин</span>
                    @endif
                    @if(!empty($movie->age_rating))
                        <span>{{ $movie->age_rating }}+</span>
                    @endif
                </div>

                <h1 class="one-movie-title">{{ $movie->name }}</h1>

                @if(!empty($movie->eng_name))
                    <p class="one-movie-original">{{ $movie->eng_name }}</p>
                @endif

                <p class="one-movie-description">{{ $movie->description }}</p>

                <div class="one-movie-ratings" aria-label="Рейтинги фильма">
                    <div class="one-movie-rating">
                        <span>ToWatch</span>
                        <strong>{{ $siteRating ? number_format($siteRating, 1) : '—' }}</strong>
                    </div>
                    <div class="one-movie-rating">
                        <span>КиноПоиск</span>
                        <strong>{{ $movie->kp_rating ?? '—' }}</strong>
                    </div>
                    <div class="one-movie-rating">
                        <span>IMDb</span>
                        <strong>{{ $movie->imdb_rating ?? '—' }}</strong>
                    </div>
                    @if($movie->film_critics_rating !== "0.00")
                        <div class="one-movie-rating">
                            <span>Критики</span>
                            <strong>{{ $movie->film_critics_rating ?? '—' }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container one-movie-page">
        <div class="one-movie-layout">
            <aside class="one-movie-sidebar">
                <div class="one-movie-poster-card">
                    <img src="{{ $movie->preview_url }}" alt="{{ $movie->name }}" class="one-movie-poster">

                    @auth
                        <form class="one-movie-actions" id="favorite-form" method="POST">
                            @csrf
                            <button
                                type="button"
                                data-action="viewed"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                data-url="{{ route('movie.action', ['id'=>$movie->id]) }}"
                                title="Просмотрено"
                                class="btn one-movie-action-btn {{ auth()->user()->isViewed($movie->id) ? 'btn-success' : 'btn-outline-success' }}">
                                {!! auth()->user()->isViewed($movie->id) ? '<i class="bi bi-check2-all"></i>' : '<i class="bi bi-check2"></i>' !!}
                            </button>

                            <button
                                id="favorite-btn"
                                type="button"
                                data-action="favorite"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                data-url="{{ route('movie.action', ['id'=>$movie->id]) }}"
                                title="Добавить в избранное"
                                class="btn one-movie-action-btn {{ auth()->user()->isFavorited($movie->id) ? 'btn-success' : 'btn-outline-success' }}">
                                {!! auth()->user()->isFavorited($movie->id) ? '<i class="bi bi-bookmark-star"></i>' : '<i class="bi bi-bookmark-star-fill"></i>' !!}
                            </button>

                            <button
                                type="button"
                                data-action="like"
                                data-url="{{ route('movie.action', ['id'=>$movie->id]) }}"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                title="Любимые"
                                class="btn one-movie-action-btn {{ auth()->user()->isLiked($movie->id) ? 'btn-success' : 'btn-outline-success' }}">
                                {!! auth()->user()->isLiked($movie->id) ? '<i class="bi bi-heart"></i>' : '<i class="bi bi-heart-fill"></i>' !!}
                            </button>

                            <button
                                type="button"
                                data-action="watchLater"
                                data-url="{{ route('movie.action', ['id'=>$movie->id]) }}"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                title="Смотреть позже"
                                class="btn one-movie-action-btn {{ auth()->user()->isWatched($movie->id) ? 'btn-success' : 'btn-outline-success' }}">
                                {!! auth()->user()->isWatched($movie->id) ? '<i class="bi bi-stopwatch"></i>' : '<i class="bi bi-stopwatch-fill"></i>' !!}
                            </button>
                        </form>
                    @endauth
                </div>
            </aside>

            <section class="one-movie-main">
                <div class="one-movie-panel">
                    <div class="one-movie-section-heading">
                        <span>Детали</span>
                        <h2>О фильме</h2>
                    </div>

                    <dl class="one-movie-facts">
                        <div>
                            <dt><i class="bi bi-film"></i> Название</dt>
                            <dd>{{ $movie->name ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt><i class="bi bi-calendar-event"></i> Год производства</dt>
                            <dd>{{ $movie->year ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt><i class="bi bi-translate"></i> Оригинальное название</dt>
                            <dd>{{ $movie->eng_name ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt><i class="bi bi-alarm"></i> Длительность</dt>
                            <dd>{{ $movie->movieLength ? $movie->movieLength . ' мин.' : '—' }}</dd>
                        </div>
                        <div class="one-movie-facts__wide">
                            <dt><i class="bi bi-cast"></i> Жанры</dt>
                            <dd class="one-movie-chips">
                                @forelse($movie->genres as $genre)
                                    <span class="genre-pill">{{ $genre->name }}</span>
                                @empty
                                    —
                                @endforelse
                            </dd>
                        </div>
                        <div class="one-movie-facts__wide">
                            <dt><i class="bi bi-camera-reels"></i> Режиссеры</dt>
                            <dd class="one-movie-people-list">
                                @forelse($movie->directors as $director)
                                    <a class="one-movie-person" href="#"
                                       tabindex="0"
                                       data-bs-toggle="popover"
                                       data-bs-trigger="hover focus"
                                       data-bs-html="true"
                                       data-bs-content="<img src='{{ $director->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $director->name }}</div>">
                                        {{ $director->name }}
                                    </a>
                                @empty
                                    <span>—</span>
                                @endforelse
                            </dd>
                        </div>
                        <div class="one-movie-facts__wide">
                            <dt><i class="bi bi-brush"></i> Художники</dt>
                            <dd class="one-movie-people-list">
                                @forelse($movie->artists as $artist)
                                    <a class="one-movie-person" href="#"
                                       tabindex="0"
                                       data-bs-toggle="popover"
                                       data-bs-trigger="hover focus"
                                       data-bs-html="true"
                                       data-bs-content="<img src='{{ $artist->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $artist->name }}</div>">
                                        {{ $artist->name }}
                                    </a>
                                @empty
                                    <span>—</span>
                                @endforelse
                            </dd>
                        </div>
                    </dl>

                    @if(auth()->check() && auth()->user()->isStaff())
                        <div class="one-movie-admin-note">
                            <i class="bi bi-shield-lock"></i>
                            <span>Информация для администратора: добавлено в БД {{ $movie->created_at }}</span>
                        </div>
                    @endif
                </div>

                <div class="one-movie-panel">
                    <div class="one-movie-section-heading">
                        <span>Каст</span>
                        <h2>Актёры</h2>
                    </div>

                    <div class="one-movie-actors">
                        @foreach($actors->take($limit) as $actor)
                            <span class="actor-chip"
                                  tabindex="0"
                                  data-bs-toggle="popover"
                                  data-bs-trigger="hover focus"
                                  data-bs-html="true"
                                  data-bs-content="<img src='{{ $actor->photo_url }}' width='150' class='img-fluid rounded mb-2'><div>{{ $actor->name }}</div>">
                                {{ $actor->name }}
                            </span>
                        @endforeach
                    </div>

                    @if($hasMore)
                        <a class="one-movie-more-link"
                           data-bs-toggle="collapse"
                           href="#actorsCollapse">
                            Показать ещё {{ $moreCount }}
                        </a>

                        <div class="collapse mt-3" id="actorsCollapse">
                            <div class="one-movie-actors one-movie-actors--more">
                                @foreach($actors->slice($limit) as $actor)
                                    <span class="actor-chip">{{ $actor->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>

        <section class="reviews-carousel-container">
            <div class="reviews-carousel-header">
                <div>
                    <button class="active" type="button">Отзывы 7</button>
                    <button type="button">Рецензии 2</button>
                </div>
                <div class="carousel-nav">
                    <button class="prev" type="button" aria-label="Предыдущие отзывы"><i class="bi bi-arrow-left"></i></button>
                    <button class="next" type="button" aria-label="Следующие отзывы"><i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <div class="reviews-carousel-wrapper">
                <div class="reviews-carousel">
                    <article class="review-card">
                        <div class="review-author">lapka.alexandrova</div>
                        <div class="review-text">Очень хороший фильм, душевный, с классным юмором, поднимает настроение и сюжет интересный</div>
                        <div class="review-footer">
                            <span class="review-date">25 июня 2020</span>
                            <div class="review-actions">
                                <span class="like">7 лайков</span>
                                <span class="dislike">0</span>
                            </div>
                        </div>
                    </article>

                    <article class="review-card">
                        <div class="review-author">elkelk</div>
                        <div class="review-text">Отличный фильм, поднял настроение! Здорово, что на французском.</div>
                        <div class="review-footer">
                            <span class="review-date">15 апреля 2020</span>
                            <div class="review-actions">
                                <span class="like">5 лайков</span>
                                <span class="dislike">0</span>
                            </div>
                        </div>
                    </article>

                    <article class="review-card">
                        <div class="review-author">АНЯ</div>
                        <div class="review-text">Посмеялись от души! Рекомендую к просмотру.</div>
                        <div class="review-footer">
                            <span class="review-date">13 июля 2020</span>
                            <div class="review-actions">
                                <span class="like">4 лайка</span>
                                <span class="dislike">0</span>
                            </div>
                        </div>
                    </article>

                    <article class="review-card">
                        <div class="review-author">Аккаунт</div>
                        <div class="review-text">Есть вопросы к логике сцены, но в целом фильм держит внимание.</div>
                        <div class="review-footer">
                            <span class="review-date">30 декабря 2020</span>
                            <div class="review-actions">
                                <span class="like">1 лайк</span>
                                <span class="dislike">0</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            const carousel = document.querySelector('.reviews-carousel');
            let offset = 0;

            document.querySelector('.next').addEventListener('click', () => {
                const maxOffset = carousel.scrollWidth - carousel.parentElement.offsetWidth;
                offset += 320;
                if (offset > maxOffset) offset = maxOffset;
                carousel.style.transform = `translateX(-${offset}px)`;
            });

            document.querySelector('.prev').addEventListener('click', () => {
                offset -= 320;
                if (offset < 0) offset = 0;
                carousel.style.transform = `translateX(-${offset}px)`;
            });

            $('#favorite-form button').on('click',function (e) {
                e.preventDefault();
                let $btn = $(this);
                let url = $btn.data('url');
                let action = $btn.data('action');

                let tooltipInstance = bootstrap.Tooltip.getInstance($btn[0]);
                if (tooltipInstance) {
                    tooltipInstance.hide();
                }

                $.ajax({
                    url: url,
                    method:'POST',
                    data:{
                        _token: $('input[name="_token"]').val(),
                        'action_type':action
                    },
                    success: function (response) {
                        if (response.status) {
                            $btn
                                .removeClass('btn-outline-success')
                                .addClass('btn-success');
                            toggleIcon($btn, true);
                        } else {
                            $btn
                                .removeClass('btn-success')
                                .addClass('btn-outline-success');
                            toggleIcon($btn, false);
                        }
                    },
                });
            });

            function toggleIcon($btn, active) {
                let icons = {
                    favorite: ['bi-bookmark-star', 'bi-bookmark-star-fill'],
                    like: ['bi-heart', 'bi-heart-fill'],
                    viewed: ['bi-check2-all', 'bi-check2'],
                    watchLater: ['bi-stopwatch', 'bi-stopwatch-fill'],
                };

                let action = $btn.data('action');
                let icon = active ? icons[action][0] : icons[action][1];

                $btn.html(`<i class="bi ${icon}"></i>`);
            }
        });
    </script>
@endsection
