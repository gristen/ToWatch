@extends('components.admin.app')

@section('content')
    <div class="admin-wrapper">
        <!-- Основной контент -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">

            <!-- Хедер -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 header-gradient">
                <h1 class="h2 mb-0"><i class="fas fa-user-shield me-2"></i>Редактирование роли</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Назад
                    </a>
                </div>
            </div>

            <!-- Форма редактирования -->
            <div class="card card-dashboard mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-bold">Название роли</label>
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control">
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3"><i class="fas fa-key me-2"></i>Права доступа</h5>

                        <div class="row">
                            @foreach($permissions as $group => $groupPermissions)

                                <h6 class="mb-2">{{ __('permissions.groups.' . $group) }}</h6>
                                @foreach($groupPermissions as $permission)
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check permission-box">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                   value="{{ $permission->id }}" id="perm{{ $permission->id }}"
                                                {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perm{{ $permission->id }}">
                                                {{ __('permissions.' . $permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Сохранить
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </main>
    </div>
@endsection
