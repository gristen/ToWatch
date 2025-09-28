@extends("components.app")

@section("content")

    <!-- close Modal -->
    <div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn fw-bold btn-success">Закрыть задачу</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

    <!-- create task Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Создание новой задачи</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('task.store')}}" class="form" method="POST">
                        @csrf
                        <label class="form-label" for="form-control">Описание новой задачи</label>
                        <input class="form-control mt-2" placeholder="Описание..." type="text">
                        <hr>
                        <select class="form-select mt-2" aria-label="Default select example">
                            <!--TODO вынести оптионы в отдельный компонент-->
                            <option selected>Выбрать срочность</option>
                            <option value="low">low</option>
                            <option value="medium">medium</option>
                            <option value="high">high</option>
                        </select>
                        <select class="form-select mt-2" aria-label="Default select example">
                            <option selected>Выбрать сложность</option>
                            <option value="low">low</option>
                            <option value="medium">medium</option>
                            <option value="high">high</option>
                        </select>
                        <div class="modal-footer">
                            <button type="submit" class="btn fw-bold btn-success">Создать задачу</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <div class="container mt-4">
            <div class="d-flex ">
                <h2>Активные задачи </h2>
                <button class="btn btn-outline-success fw-bold ms-auto" data-bs-toggle="modal" data-bs-target="#createModal "> Создать новую задачу</button>
            </div>
            <hr>
            @foreach($tasks as $task)
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-dark shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{$task->title}}</h5>
                            <p class="card-text">{{$task->description}}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span class="badge bg-warning text-dark">{{$task->difficulty}}</span>
                            <span class="badge bg-danger">Срочность: {{$task->urgency}}</span>
                        </div>
                        <button class="btn fw-bold btn-success mb-3 w-50 m-auto" data-bs-toggle="modal" data-bs-target="#closeModal"> Закрыть задачу</button>
                    </div>
                </div>
            </div>
            @endforeach

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
