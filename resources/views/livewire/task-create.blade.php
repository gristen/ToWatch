<div>

    <label class="form-label" for="form-control">Заголовок задачи</label>
        <div>@error('form.title') {{ $message }} @enderror</div>
    <input wire:model="form.title" name="title" class="form-control mt-2" placeholder="Заголовок..." type="text">
    <label class="form-label" for="form-control">Описание новой задачи</label>
    <textarea wire:model="form.description" name="description" class="form-control mt-2" placeholder="Описание..." type="text"></textarea>
    <hr>
    <select wire:model="form.urgency" name="urgency" class="form-select mt-2" aria-label="Default select example">
        <!--TODO вынести оптионы в отдельный компонент-->
        <option selected>Выбрать срочность</option>
        <option value="low">low</option>
        <option value="medium">medium</option>
        <option value="high">high</option>
    </select>
    <select wire:model="form.difficulty" name="difficulty" class="form-select mt-2" aria-label="Default select example">
        <option selected>Выбрать сложность</option>
        <option value="low">low</option>
        <option value="medium">medium</option>
        <option value="high">high</option>
    </select>
    <div class="modal-footer">
        <button wire:click="store" type="submit" class="btn btn-primary my-2">add</button>
    </div>

</div>
