@extends('components.admin.app')

@section('content')
    <div class="container py-4">
        <x-admin.header title="Роли проекта"></x-admin.header>
        @include('components.admin.sidebar')
        {{-- Флеш сообщение --}}
    @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mb-4">

            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body d-flex gap-2 align-items-center">
                        <form action="" method="POST" class="d-flex gap-2 w-100">
                            @csrf
                            <input type="text" name="name" class="form-control" placeholder="Название роли">
                            <button class="btn btn-primary">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Таблица ролей --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th class="text-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="text-end d-flex gap-2 justify-content-end">
                                <a href="{{route('admin.roles.edit',$role)}}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> Редактировать
                                </a>
                                <form action="" method="POST" onsubmit="return confirm('Удалить роль?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i> Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if($roles->isEmpty())
                    <div class="text-center text-muted py-3">
                        Нет ролей для отображения
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
