@extends("components.app")

@section("content")

    <div class="container mt-4">
        <div class="d-flex ">
            <h2>Активные задачи </h2>
            <button class="btn btn-outline-success fw-bold ms-auto"> create new task</button>
        </div>
        <hr>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Сделать импорт фильмов</h5>
                        <p class="card-text">Реализовать команду для массовой загрузки фильмов из API Кинопоиска.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span class="badge bg-warning text-dark">Сложность: Средняя</span>
                        <span class="badge bg-danger">Срочность: Срочно</span>
                    </div>
                </div>
            </div>


        </div>

        <h2 class="mt-5 mb-3">completed</h2>
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
