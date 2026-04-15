<!-- Таблица с данными -->
<div class="card card-dashboard">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <i class="fas fa-table me-2 text-success"></i>
            <h5 class="card-title mb-0">Последние регистрации</h5>
        </div>
        <div class="card-actions">
            <div class="input-group input-group-sm" style="width: 250px;">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Поиск...">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                <tr>
                    <th class="ps-4" width="50">#</th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Дата регистрации</th>
                    <th>Статус</th>
                    <th class="text-end pe-4">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="ps-4">1</td>
                        <td><span class="badge bg-secondary">{{$user->id}}</span></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial bg-primary rounded-circle me-2">a</div>
                                {{$user->email}}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">

                                {{$user->name}}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">

                                {{$user->role->name}}
                            </div>
                        </td>
                        <td>{{$user->created_at}}</td>
                        <td><span class="badge badge-soft-success">Активен</span></td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-icon btn-outline-primary" title="Редактировать">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-outline-info" title="Просмотр">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-outline-danger" title="Удалить">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-transparent">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm justify-content-center mb-0">
                {{ $users->links(data: ['scrollTo' => false]) }}
            </ul>
        </nav>
    </div>
</div>
