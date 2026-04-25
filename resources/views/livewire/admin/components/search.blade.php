<div class="position-relative">

    <input
        wire:model.live.debounce.300ms="search"
        type="text"
        class="form-control form-control-lg shadow-sm"
        placeholder="Поиск пользователя..."
    >

    @if($search)
        <div class="list-group position-absolute w-100 mt-1 shadow-lg rounded-3 overflow-hidden"
             style="z-index: 1050; max-height: 320px; overflow-y: auto;">

            @forelse($rows as $row)

                <a href="{{ route('admin.users.show', $row) }}" class="list-group-item list-group-item-action border-0 py-2 px-3">

                    <div class="d-flex align-items-center gap-3">


                        <!-- text -->
                        <div class="flex-grow-1">

                            <div class="fw-semibold">
                                {{ data_get($row, 'name') }}
                            </div>

                            <div class="text-muted small">
                                {{ data_get($row, 'email') }}
                            </div>

                        </div>

                        @if($subField)
                            <span class="badge {{$row->role->getBadgeClass()}}">
                                {{ data_get($row, $subField) }}
                            </span>
                        @endif

                    </div>

                </a>

            @empty

                <div class="text-center py-3 text-muted">
                    Ничего не найдено 😢
                </div>

            @endforelse

        </div>
    @endif

</div>
