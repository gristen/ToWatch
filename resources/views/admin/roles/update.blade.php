@extends('components.admin.app')

@section('content')

    <div class="container-fluid">

        <x-admin.header title="Редактирование роли">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Назад
            </a>
        </x-admin.header>

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold">Название роли</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ $role->name }}"
                            class="form-control"
                        >
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">
                        <i class="fas fa-key me-2"></i>
                        Права доступа
                    </h5>

                    <div class="row">

                        @foreach($permissions as $permission)

                            <div class="col-md-3 mb-3">
                                <div class="form-check permission-box">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->id }}"
                                        id="perm{{ $permission->id }}"

                                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label" for="perm{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>

                                </div>
                            </div>

                        @endforeach

                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end">

                        <button class="btn btn-success">
                            <i class="fas fa-save me-1"></i>
                            Сохранить
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
