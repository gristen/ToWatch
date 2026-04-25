<?php

namespace App\Livewire\Admin\Components;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use function Laravel\Prompts\select;

class Table extends Component
{
    use WithPagination;

    public ?string $title = null;
    public $handler;
    public $limit = 10;
    public array $columns = [];
    public array $searchColumns = [];
    public array $actions = [];
    public string $search = '';
    public $sortField = 'name'; // Столбец по умолчанию
    public $sortAsc = true;    // Направление
    public ?int $deleteId = null;
    public ?string $deleteLabel = null;
    //
    public $editingId = null;      // ид модели которую редачим
    public $editingField = null;   // какое поле (email, name)
    public $editingValue = null;   // текущее значение в input
    public function startEdit($id, $field, $value)
    {
        debugbar()->info("start edit field. Data : $id, $field, $value");
        $this->editingId = $id;
        $this->editingField = $field;
        $this->editingValue = $value;
    }
    public function saveEdit()
    {
        $model = $this->handler::find($this->editingId);

        if (!$model) return;

        // 💥 ВАЖНО: если relation
        if (str_contains($this->editingField, '.')) {

            [$relation, $field] = explode('.', $this->editingField);

            // например role.name → role_id
            $foreignKey = $relation . '_id';

            $model->{$foreignKey} = $this->editingValue;

        } else {

            $model->{$this->editingField} = $this->editingValue;
        }

        $model->save();

        // сброс режима редактирования
        $this->editingId = null;
        $this->editingField = null;
        $this->editingValue = null;
    }
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;

    }

    public function updatingSearch() // хук от лавваир, без обновления страницы баги с пагинацией
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        debugbar()->info($id);
        $item = $this->handler::find($id);
        $this->dispatch('initDeleteModal');
        $this->deleteId = $id;
        $this->deleteLabel = $item->name ?? $item->title ?? "элемент c id = {{$item->id}} ";
    }

    public function delete()
    {

        $this->handler::delete($this->deleteId);
        $this->dispatch('deleted',
            [
                'response' => '✅Удаление прошло успешно',
                'id' => $this->deleteId,
            ]);
        $this->deleteId = null;
    }

    public function render()
    {
        $table = $this->handler::table();

        debugbar()->info("table: $table");

        $query = ($this->handler)::query()
            ->when($this->search, function ($q) {
                $q->search($this->search, $this->searchColumns);
            })
            ->when($this->sortField, function (Builder $q, $sort) use ($table) {
                debugbar()->info("sortField = : $sort");
                if (str_contains($this->sortField, '.')) {

                    $config = collect($this->columns)->firstWhere('field', $this->sortField);
                    debugbar()->info($this->columns);
                    debugbar()->info($config);
                    $q->leftJoin(
                        $config['table'],                 // roles
                        $config['table'] . '.id',         // roles.id
                        '=',
                        $table . '.' . $config['foreign_key']
                    )
                        ->orderBy(
                            $config['table'] . '.' . explode('.', $this->sortField)[1]
                            , $this->sortAsc ? 'asc' : 'desc'
                        )
                        ->select($table . '.*');
                    return;
                }
                $q->orderBy($sort, $this->sortAsc ? 'asc' : 'desc');
            });

        return view('livewire.admin.components.table',
            ['rows' => $query->paginate($this->limit)]);
    }
}
