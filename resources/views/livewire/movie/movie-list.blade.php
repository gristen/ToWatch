<div>
    <!-- Модальное окно -->


    <div class="modal fade " id="closeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Подтверждение действий</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('Movie.MovieCloseConfirm')
                </div>
            </div>
        </div>
    </div>

    <h2 class="fw-bold mb-4 text-light">🎬 Каталог фильмов</h2>
    @livewire('movie.MovieFilter')
    <div class="row g-4">

        @foreach($movies as $movie)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="movie-tile">

                    <img
                        src="{{ $movie->preview_url ?? asset('poster.jpg') }}"
                        alt="{{ $movie->name }}"
                    >

                    <span class="movie-type">
                     {{ strtoupper(__("index.{$movie->type}")) }}
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

                        @if(Auth::check() && Auth::user()->role->id < 3)
                            <button
                                class="btn btn-danger btn-sm w-100 mt-1"
                                data-bs-toggle="modal"
                                data-bs-target="#closeModal"
                                wire:click="$dispatch('set-movie-id', { id: {{ $movie->id }} })"
                            >
                                Удалить
                            </button>
                        @endif
                    </div>

                </div>
            </div>

        @endforeach
    </div>


    {{$movies->links()}}


    <script>


        document.addEventListener('DOMContentLoaded', function () {
            const closeModal = document.getElementById('closeModal');

            closeModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // кнопка, которая открыла модал

            });
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('movie-closed', () => {
                console.log('✅');
                const modalEl = document.getElementById('closeModal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                }

            });


        });

    </script>
</div>
