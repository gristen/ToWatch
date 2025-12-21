<div class="">
    <!-- Модальное окно -->

    <div class="modal fade hero-slide" id="closeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999" wire:ignore>
        <div id="livewireToast" class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>



    <div class="container-fluid px-0"> <!-- Убираем горизонтальные паддинги -->
        <div class="movie-carousel full-width mb-5">
        <div id="moviesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach($movies->take(5) as $index => $movie)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="hero-slide">

                            <!-- BLUR BACKGROUND -->
                            <div
                                class="hero-bg"
                                style="background-image:url('{{ $movie->preview_url }}')"
                            ></div>

                            <!-- CONTENT -->
                            <div class="hero-content">
                                <div class="row align-items-center h-100">

                                    <div class="col-md-6 text-light">
                                        <h1 class="fw-bold">{{ $movie->name }}</h1>
                                        <p class="text-secondary">{{ $movie->year }}</p>

                                        <a href="{{ route('movie.show', $movie) }}"
                                           class="btn btn-success fw-bold px-4">
                                            Смотреть
                                        </a>
                                    </div>

                                    <!-- POSTER -->
                                    <div class="col-md-6 text-end d-none d-md-block">
                                        <img
                                            src="{{ $movie->preview_url }}"
                                            class="hero-poster"
                                            alt="{{ $movie->name }}"
                                        >
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    </div>

    <div class="mb-4">
        <div class="d-flex flex-wrap gap-2 align-items-center">

            <input
                type="text"
                class="form-control form-control-sm bg-dark text-white border-0"
                style="max-width: 260px"
                placeholder="Поиск..."
            >

            <select class="form-select form-select-sm bg-dark text-white border-0" style="max-width: 160px">
                <option>Все</option>
                <option>Фильмы</option>
                <option>Сериалы</option>
            </select>

            <select class="form-select form-select-sm bg-dark text-white border-0" style="max-width: 140px">
                <option>Год</option>
                <option>2025</option>
                <option>2024</option>
            </select>

            <button class="btn btn-success btn-sm fw-bold px-3">
                OK
            </button>

        </div>
    </div>
    <h2 class="fw-bold mb-4 text-light">🎬 Каталог фильмов</h2>
    <div class="row g-4">
        @foreach($movies as $movie)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="movie-tile">

                    <img
                        src="{{ $movie->preview_url ?? asset('poster.jpg') }}"
                        alt="{{ $movie->name }}"
                    >

                    <span class="movie-type">
                        {{ strtoupper($movie->type ?? 'movie') }}
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

            Livewire.on('toast', (data) => {
                const toastEl = document.getElementById('livewireToast');
                const messageEl = document.getElementById('toastMessage');

                toastEl.className = 'toast align-items-center border-0';
                toastEl.classList.add(`text-bg-${data.type}`);

                messageEl.textContent = data.message;

                const toast = new bootstrap.Toast(toastEl, {delay: 3000});
                toast.show();
            });

        });

    </script>
</div>
