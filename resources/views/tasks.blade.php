@extends("components.app")

@section("content")

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Закрытие задачи</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" class="form" method="POST">
                        @csrf
                        <label class="form-label" for="form-control">Ссылка на коммит</label>
                        <input class="form-control" placeholder="Ссылка на коммит github..." type="text">
                        <label class="form-label" for="form-control">коментарий к закрытой задачи</label>
                        <input class="form-control" placeholder="Коментарий..." type="text">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success">Закрыть задачу</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="d-flex ">
                <h2>Активные задачи </h2>
                <button class="btn btn-outline-success fw-bold ms-auto"> create new task</button>
            </div>
            <hr>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-dark shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Сделать импорт фильмов</h5>
                            <p class="card-text">Реализовать команду для массовой загрузки фильмов из API Кинопоиска.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span class="badge bg-warning text-dark">Сложность: Средняя</span>
                            <span class="badge bg-danger">Срочность: Срочно</span>
                        </div>
                        <a href="#" class="btn btn-success mb-3 w-50 m-auto" data-bs-toggle="modal" data-bs-target="#exampleModal"> Закрыть задачу</a>
                    </div>
                </div>
            </div>

            <h2 class="mt-5 mb-3">Завершенные задачи</h2>
            <hr class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-warning shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Добавить поиск по фильмам</h5>
                            <p class="card-text">Форма поиска + вывод результатов с пагинацией.</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span class="badge bg-danger">Сложность: Высокая</span>
                            <span class="badge bg-warning text-dark">Срочность: Средняя</span>
                        </div>
                    </div>
                </div>
                @for($i = 0; $i < 3;$i++)
                    <div class="col-md-4 mb-5 ">
                        <div class="card border-warning shadow-sm h-100 ">
                            <div class="card-body">
                                <h5 class="card-title">Добавить поиск по фильмам</h5>
                                <p class="card-text">Форма поиска + вывод результатов с пагинацией.</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <span class="badge bg-danger">Сложность: Высокая</span>
                                <span class="badge bg-warning text-dark">Срочность: Средняя</span>
                            </div>
                        </div>
                    </div>

                @endfor


            </div>

        </div>

@endsection
