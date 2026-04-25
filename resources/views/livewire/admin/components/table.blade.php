<div>

    <div class="card card-dashboard mt-2">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <i class="fas fa-table me-2 text-success"></i>
                <h5 class="card-title mb-0">{{ $title }}</h5>
            </div>

            <div class="card-actions">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <span class="input-group-text bg-transparent border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input wire:model.live="search" type="text"
                           class="form-control border-start-0 ps-0"
                           placeholder="Поиск...">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                    <tr>
                        @foreach($columns as $col)
                            @php $isActive = $sortField === $col['field']; @endphp

                            <th wire:click="sortBy('{{ $col['field'] }}')"
                                style="cursor:pointer;"
                                class="{{ $isActive ? 'text-primary' : '' }}">

                                {{ $col['label'] }}

                                @if($isActive)
                                    <i class="bi {{ $sortAsc ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                                @endif
                            </th>
                        @endforeach

                        <th>actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rows as $row)
                        <tr>
                            @foreach($columns as $col)

                                <td>
                                    @php $value = data_get($row, $col['field']); @endphp

                                    @if($editingId === $row->id && $editingField === $col['field'])
                                        @if(($col['type'] ?? null)=== 'select')

                                            <select
                                                wire:model="editingValue"
                                                wire:change="saveEdit"
                                                class="form-select form-select-sm"
                                            >
                                                @foreach($col['options'] as $id => $label)
                                                    <option value="{{ $id }}">{{ $label }}</option>
                                                @endforeach
                                            </select>

                                        @else

                                            <input
                                                wire:model.defer="editingValue"
                                                wire:blur="saveEdit"
                                                wire:keydown.enter="saveEdit"
                                                class="form-control form-control-sm"
                                            >

                                        @endif

                                    @else

                                        <span
                                            wire:click="startEdit(
                                                    {{ $row->id }},
                                                    '{{ $col['field'] }}',
                                                    @js(($col['relation'] ?? null)
                                                    ? $row->{$col['relation']}?->id
                                                    : $value)
                                                )"
                                                                                >
                                                {{ $value }}
                                        </span>

                                    @endif
                                </td>
                            @endforeach

                            <td class="text-end pe-4">
                                @foreach($actions as $action)

                                    @if($action['type'] === "edit")
                                        <a class="btn btn-sm btn-outline-primary"
                                           title="{{$action['title']}}">
                                            <i class="{{$action['icon']}}"></i>
                                        </a>
                                    @endif

                                    @if($action['type'] === 'delete')
                                        <button
                                            wire:click="confirmDelete({{ $row->id }})"
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            title="{{ $action['title'] }}">
                                            <i class="{{ $action['icon'] }}"></i>
                                        </button>
                                    @endif

                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table> <!-- ✅ ВАЖНО: закрыли таблицу -->
            </div>
        </div>

        <div class="card-footer bg-transparent">
            {{ $rows->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

    <!-- ✅ МОДАЛКА ВНЕ ТАБЛИЦЫ -->
    <div id="deleteModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Подтверждение</h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Ты точно хочешь удалить
                    <span class="fw-bold">{{ $deleteLabel }}</span> ?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Отмена
                    </button>

                    <button class="btn btn-danger"
                            wire:click="delete">
                        Удалить
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>


<script>

    document.addEventListener('livewire:init', () => {

        Livewire.on('initDeleteModal', (data) => {

            const deleteModal = document.getElementById('deleteModal');

        });


        Livewire.on('deleted', (data) => {
            console.log('✅ Deleted');
            console.log(data);

            const toastEl = document.getElementById('successToast');

            const toast = new bootstrap.Toast(toastEl);
            const toastBody = toastEl.querySelector('.toast-body');
            if (toastBody) {
                toastBody.innerHTML = data[0].response;
            }

            toast.show();
        });
        Livewire.on('task-closed', () => {
            console.log('✅ Задача успешно закрыта!');


            const toastEl = document.getElementById('successToast');
            const toast = new bootstrap.Toast(toastEl);
            const toastBody = toastEl.querySelector('.toast-body');
            if (toastBody) {
                toastBody.innerHTML = "✅ Задача успешно завершена!";
            }
            toast.show();
        });
    });
</script>
