<div>

    {{--<input wire:model="form.id" type="hidden" name="id" id="close-task-id" value="">--}}
        <label class="form-label" for="form-control">Ссылка на коммит</label>
        <input wire:model="form.link_git" name="link_git" class="form-control" placeholder="Ссылка на коммит github..."
               type="text">
        <label class="form-label" for="form-control">коментарий к закрытой задачи</label>
        <input wire:model="form.comment" name="comment" class="form-control" placeholder="Коментарий..." type="text">
        <div class="modal-footer">
            <button wire:click="closeTask"  class="btn fw-bold btn-success">Закрыть задачу</button>
        </div>

</div>
