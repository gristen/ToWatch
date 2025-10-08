@extends("components.app")

@section("content")
    @php
        $translate = [
            'high' => 'Высокая',
            'medium' => 'Средняя',
            'low' => 'Низкая',
        ];

    @endphp
        <!-- close Modal -->
    <div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Закрытие задачи : <p id="task-title"></p></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="close-form" action="" class="form" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="task_id" id="close-task-id" value="">
                        <label class="form-label" for="form-control">Ссылка на коммит</label>
                        <input name="link_git" class="form-control" placeholder="Ссылка на коммит github..."
                               type="text">
                        <label class="form-label" for="form-control">коментарий к закрытой задачи</label>
                        <input name="comment" class="form-control" placeholder="Коментарий..." type="text">
                        <div class="modal-footer">
                            <button type="submit" class="btn fw-bold btn-success">Закрыть задачу</button>
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

                        <label class="form-label" for="form-control">Заголовок задачи</label>
                        <input name="title" class="form-control mt-2" placeholder="Заголовок..." type="text">
                        <label class="form-label" for="form-control">Описание новой задачи</label>
                        <input name="description" class="form-control mt-2" placeholder="Описание..." type="text">
                        <hr>
                        <select name="urgency" class="form-select mt-2" aria-label="Default select example">
                            <!--TODO вынести оптионы в отдельный компонент-->
                            <option selected>Выбрать срочность</option>
                            <option value="low">low</option>
                            <option value="medium">medium</option>
                            <option value="high">high</option>
                        </select>
                        <select name="difficulty" class="form-select mt-2" aria-label="Default select example">
                            <option selected>Выбрать сложность</option>
                            <option value="low">low</option>
                            <option value="medium">medium</option>
                            <option value="high">high</option>
                        </select>
                        <div class="modal-footer">
                            <button
                                type="submit" class="btn fw-bold btn-success">Создать задачу
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="d-flex ">
            <h2>Активные задачи </h2>
            <button class="btn btn-outline-success fw-bold ms-auto" data-bs-toggle="modal"
                    data-bs-target="#createModal "> Создать новую задачу
            </button>
        </div>

        <hr>
        <div class="row g-4">
            @if(isset($tasks))
                @foreach($tasks as $task)
                    <div class="col-md-4">
                        <div class="card border-dark shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{$task->title}}</h5>
                                <p class="card-text">{{$task->description}}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <span
                                    class="badge bg-warning text-dark"> Сложность: {{$translate[$task->difficulty]}}</span>
                                <span class="badge bg-danger">Срочность: {{$translate[$task->urgency]}}</span>
                            </div>
                            <button class="btn fw-bold btn-success mb-3 w-50 m-auto"
                                    data-bs-toggle="modal"
                                    data-task-id="{{$task->id}}"
                                    data-task-title="{{$task->title}}"
                                    data-bs-target="#closeModal">
                                Закрыть задачу
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
            <p>Активных задач нет , отдыхай дружок</p>
            @endif
        </div>

        <h2 class="mt-5 mb-3">Завершенные задачи</h2>
        <hr class="mb-3">
        <div class="row">
            @foreach($tasksCompleted as $taskCompleted)
                <div class="col-md-4 mt-3">
                    <div class="card border-success shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{$taskCompleted->title}}</h5>
                            <p class="card-text">{{$taskCompleted->description}}</p>
                            <p class="card-text">ссылка на коммит
                                гита: {{$taskCompleted->link_git ?? "Ссылка отстутсвует"}}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <span class="badge bg-danger">Сложность: Высокая</span>
                            <span class="badge bg-warning text-dark">Срочность: Средняя</span>
                        </div>
                    </div>
                </div>
            @endforeach
                </div>

            </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const closeModal = document.getElementById('closeModal');

            closeModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // кнопка, которая открыла модал
                const taskId = button.getAttribute('data-task-id');
                const taskTitle = button.getAttribute('data-task-title');

                closeModal.querySelector('#close-task-id').value = taskId;
                closeModal.querySelector('#task-title').textContent = taskTitle;
                closeModal.querySelector('#close-form').action = `/task/${taskId}`;

            });
        });
    </script>


@endsection
