<div>
    <form wire:submit.prevent="store">
        <div class="form-floating mb-4">
            @error('form.title')
            <div class="invalid-feedback">123</div>
            @enderror
            <label for="titleInput">
                <i class="bi bi-pencil me-1"></i>
                Заголовок задачи
            </label>
            <input
                wire:model="form.title"
                type="text"
                class="form-control @error('form.title') is-invalid @enderror"
                id="titleInput"
                placeholder="">
        </div>

        <!-- Floating label для описания -->
        <div class="form-floating mb-4">
            <textarea
                wire:model="form.description"
                class="form-control @error('form.description') is-invalid @enderror"
                id="descriptionTextarea"
                placeholder=" "
                style="height: 120px;"></textarea>
            <label for="descriptionTextarea">
                <i class="bi bi-file-text me-1"></i>
                Описание задачи
            </label>
            @error('form.description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="form-floating">
                    <select
                        wire:model="form.urgency"
                        class="form-select @error('form.urgency') is-invalid @enderror"
                        id="urgencySelect">
                        <option value="" disabled selected></option>
                        <option value="low">Низкая</option>
                        <option value="medium">Средняя</option>
                        <option value="high">Высокая</option>
                    </select>
                    <label for="urgencySelect">
                        <i class="bi bi-lightning-charge me-1"></i>
                        Срочность
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <select
                        wire:model="form.difficulty"
                        class="form-select @error('form.difficulty') is-invalid @enderror"
                        id="difficultySelect">
                        <option value="" disabled selected></option>
                        <option value="low">Низкая</option>
                        <option value="medium">Средняя</option>
                        <option value="high">Высокая</option>
                    </select>
                    <label for="difficultySelect">
                        <i class="bi bi-bar-chart-steps me-1"></i>
                        Сложность
                    </label>
                </div>
            </div>
        </div>

        <input wire:model="form.type" type="hidden" value="backend">

        <div class="d-flex gap-2 mt-4">
            <button type="button" class="btn btn-outline-secondary w-100 py-2" data-bs-dismiss="modal">
                Отмена
            </button>
            <button type="submit" class="btn btn-success w-100 py-2" wire:loading.attr="disabled">
                <i class="bi bi-check-circle me-1"></i>
                Создать задачу
            </button>
        </div>
    </form>
</div>
