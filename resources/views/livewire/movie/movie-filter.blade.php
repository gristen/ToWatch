<div>
    <div class="mb-4">
        <div class="d-flex form-filter justify-content-center gap-2 align-items-center">
            <input
                wire:model.live="search"
                type="text"
                class="form-control form-control-sm bg-dark text-white border-0 w-25"
                placeholder="Поиск фильма...">

            <select wire:model.live="genre" class="form-select form-select-sm bg-dark text-white border-0 w-25">
                <option value="">Выбрать жанр...</option>
                @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
            </select>

            <select wire:model.live="year" class="form-select form-select-sm bg-dark text-white border-0 w-25">
                <option value="">Выбрать год...</option>
                @for($i = $maxYear; $i > $minYear; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>

        </div>
        @if($search && $movie->count())

            <div
                class="position-absolute bg-dark border border-secondary rounded-4 shadow-lg p-2 mt-1"
                style="
                    width: 420px;
                    z-index: 1050;
                    left: 12%;
                "
            >

                @foreach($movie as $film)

                    <a
                        href="{{ route('movie.show', $film->id) }}"
                        class="text-decoration-none"
                    >

                            <div class="
                                d-flex
                                align-items-center
                                gap-3
                                p-2
                                rounded-3
                                search-movie-item
                            ">

                            <!-- постер -->
                            <img
                                src="{{ $film->preview_url ?? asset('poster.jpg') }}"
                                alt="{{ $film->name }}"
                                width="55"
                                height="80"
                                class="rounded-3 object-fit-cover"
                            >

                            <!-- инфа -->
                            <div class="flex-grow-1">

                                <div class="fw-bold text-white">
                                    {{ $film->name }}
                                </div>

                                <div class="small text-secondary">

                                    {{ $film->year }}
                                    •
                                    ⭐ {{ $film->imdb_rating }}

                                </div>

                                <div class="mt-1 d-flex gap-1 flex-wrap">

                                    @foreach($film->genres->take(2) as $genre)

                                        <span class="badge bg-secondary-subtle text-light">

                                    {{ $genre->name }}

                                </span>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

        @endif
    </div>
</div>
