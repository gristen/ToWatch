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
                <input wire:model.live="search" type="text" class="form-control border-start-0 ps-0" placeholder="Поиск...">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                @foreach($columns as $col)
                    @php
                        $isActive = $sortField === $col['field'];
                    @endphp

                    <th
                        wire:click="sortBy('{{ $col['field'] }}')"
                        style="cursor:pointer;"
                        class="{{ $isActive ? 'text-primary' : '' }}"
                    >
                        {{ $col['label'] }}
                        @if($isActive)
                            @if($sortAsc)
                                <i class="bi bi-arrow-up"></i>
                            @else
                                <i class="bi bi-arrow-down"></i>
                            @endif
                        @endif

                    </th>
                @endforeach

                <th>actions</th>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr>
                        @foreach($columns as $col)
                            <td>{{ data_get($row, $col['field']) }}</td>
                        @endforeach
                            <td class="text-end pe-4">
                                <a class="btn btn-sm btn-icon btn-outline-primary" title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a data-bs-toggle="tooltip"
                                   data-bs-placement="bottom"
                                   title="Просмотр"
                                   class="btn btn-sm btn-icon btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a wire:click="delete({{$row->id}})" class="btn btn-sm btn-icon btn-outline-danger" title="Удалить">
                                    <i class="fas fa-trash"></i>
                                </a>
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
                {{ $rows->links(data: ['scrollTo' => false]) }}
            </ul>
        </nav>
    </div>
</div>
<script>

    document.addEventListener('livewire:init', () => {

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
