<div>
    <div class="d-flex flex-wrap gap-2">

        <input wire:model="about" class="form form-control input-group w-100 mb-3 " type="text" name="about"
               placeholder="расскажи о себе...">
        @foreach($genres as $genre)
            <button
                wire:key="genre-{{ $genre->id }}"
                wire:click="toggle({{ $genre->id }})"
                class="btn btn-sm rounded-pill
                {{ in_array($genre->id, $selected)
                    ? 'btn-success'
                    : 'btn-outline-secondary' }}"
            >
                {{ $genre->name }}
            </button>
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button wire:click="saveProfile" type="button" class="btn btn-success">Сохранить изменения</button>
    </div>
</div>
