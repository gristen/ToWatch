<div>
    <x-admin.header title="Панель пользователей"></x-admin.header>
    <livewire:admin.components.search
        :handler="\App\Handlers\UserHandler::class"
        :searchColumns="
        ['id','email', 'name']
        "
        :displayField="[
            'name','email'
        ]"
        subField="role.name"
    />

</div>
