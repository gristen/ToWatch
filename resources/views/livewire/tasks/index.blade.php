<div>

    <div>
        <div class="container mt-4">
            <x-admin.header title="Задачи проекта"></x-admin.header>
            <div class="text-center mb-5">
                <h1>Выберите тип задач</h1>
            </div>
            <div class="row justify-content-center g-4">
                <!-- Кнопка Frontend -->
                <div class="col-md-5">
                    <a href="/tasks/frontend" class="text-decoration-none">
                        <div class="card bg-primary text-white text-center p-5 shadow-lg" style="cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                            <span class=" counter badge text-bg-secondary  bg-danger position-absolute">{{$counters['frontend'] ?? "0"}}</span>
                            <div class="card-body">
                                <i class="bi bi-code-slash" style="font-size: 5rem;"></i>
                                <h2 class="mt-3">Frontend</h2>
                                <p class="lead">Задачи по фронтенд разработке</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Кнопка Backend -->
                <div class="col-md-5">
                    <a href="{{route('showTaskList', ['type'=>'backend'])}}" class="text-decoration-none">
                        <div class="card bg-success text-white text-center p-5 shadow-lg" style="cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                            <span class=" counter badge text-bg-secondary  bg-danger position-absolute">{{$counters['backend']}}</span>
                            <div class="card-body">
                                <i class="bi bi-gear" style="font-size: 5rem;"></i>
                                <h2 class="mt-3">Backend</h2>
                                <p class="lead">Задачи по бэкенд разработке</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Кнопка "Все задачи" -->
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-success btn-lg">
                    Показать все задачи
                </a>
            </div>
        </div>
    </div>

</div>
