<div>
    <div class="mb-4">
        <div class="d-flex form-filter justify-content-center gap-2 align-items-center">
            <input
                wire:model.live="search"
                type="text"
                class="form-control form-control-sm bg-dark text-white border-0 w-25"
                placeholder="Поиск...">


            <select wire:model.live="genre" class="form-select bg-dark text-white border-0 w-25">

                @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
            </select>

            <select wire:model.live="year" class="form-select form-select-sm bg-dark text-white border-0 w-25">
                <option value="">Год</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
            </select>

        </div>
    </div>
</div>
