<div>
    <x-admin.header title="Панель пользователей"></x-admin.header>
    <div class="position-relative" >

        <!-- input -->
        <input
            type="text"
            class="form-control"
            placeholder="Поиск пользователя..."
        >

        <!-- dropdown результаты -->
        <div class="list-group position-absolute w-100 shadow mt-1" style="z-index: 1000;">

            <button class="list-group-item list-group-item-action">
                <div class="fw-bold">admin@mail.ru</div>
                <small class="text-muted">Администратор</small>
            </button>
        </div>
    </div>
{{--    <x-admin.stat-card--}}
{{--        class="stat-card-primary"--}}
{{--        icon="fas fa-users"--}}
{{--        label="Пользователи"--}}
{{--        :value="1"--}}
{{--        :change="2"--}}
{{--        changeType="positive"--}}
{{--        footer="За последний месяц"--}}
{{--    />--}}
{{--    <livewire:admin.components.table
        :model="\App\Models\User::class"
        title="Пользователи"
        :searchColumns="['email','name']"
        :limit="20"
        :actions="[
                      'delete'=>'admin.user.destroy'
                    ]"
        :columns="[
                    ['field' => 'email', 'label' => 'Email'],
                    ['field' => 'name', 'label' => 'Username'],
                    ['field' => 'created_at', 'label' => 'Дата регистрации'],
                    [
                    'field' => 'role.name',
                    'label' => 'Роль',
                    'sortable' => true,
                    'relation' => 'role',
                    'table' => 'roles',
                    'foreign_key' => 'role_id'
                    ]
                    ]"
    />--}}
</div>
