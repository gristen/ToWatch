<div>
    <x-admin.header title="Панель пользователей"></x-admin.header>
    <livewire:admin.components.search
        :handler="\App\Handlers\UserHandler::class"
        :searchColumns="
        ['id','email', 'name']
        "
        :displayField="[
            'name',
        ]"
        subField="role.name"

    />
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
