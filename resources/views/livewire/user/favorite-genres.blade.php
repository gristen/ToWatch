<div>
    <div class="d-flex flex-wrap gap-2">
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

</div>
