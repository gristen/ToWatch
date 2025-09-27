    @extends("components.app")

    @section("content")

    @dump($movies)
        <div class="container">
            <h3 class="mt-3">Фильмы</h3>
            <hr>
            <div class="movies">
                @foreach($movies as $movie)
                <div class="movies_item">
                    <a href="/" class="card d-flex flex-row text-decoration-none movies__item">
                        <div class="movie-img  d-flex">
                            <img src="{{ $movie->preview_url ?? url("poster.jpg") }}"
                                 height="200px"
                                 class="card-img-top me-3"
                                 alt="...">
                            <div class="movie_titles">
                                <h4 class="card-title mr-3">{{$movie->name}}</h4>
                                @foreach($movie->countries as $country )
                                    <p class="card_country_name mr-3"> Выпуск: {{$country->name}}</p>
                                @endforeach
                                <p class="alternative_title">{{$movie->eng_name}}</p>
                            </div>
                        </div>
                        <div class="card_review">
                            <p class="card-text">
                                Оценка <span class="badge bg-warning warn__badge">7.9</span>
                            </p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            {{$movies->links()}}

        </div>
    @endsection
