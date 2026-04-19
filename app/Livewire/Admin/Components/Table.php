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
    public $model;
    public $limit = 10;
    public array $columns = [];
    public array $searchColumns = [];
    public array $actions = [];
    public string $search = '';
    public $sortField = 'name'; // Столбец по умолчанию
    public $sortAsc = true;    // Направление

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        }else{
            $this->sortAsc = true;
        }
        $this->sortField = $field;

    }
    public function updatingSearch() // хук от лавваир, без обновления страницы баги с пагинацией
    {
        $this->resetPage();
    }

    public function delete(int $id)
    {
       $res = ($this->model)::query()->findOrFail($id)->delete();
        $this->dispatch('deleted', ['response' => '✅Удаление прошло успешно', 'id' => $id]);
    }

    public function render()
    {
        $table = (new $this->model)->getTable();

        debugbar()->info("table: $table");

        $query = ($this->model)::query()
            ->when($this->search, function (Builder $q, $search){ // when проверяет перевый параметр на falsy
                foreach ($this->searchColumns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }
            }
            )

            ->when($this->sortField, function (Builder $q, $sort) use ($table) {
                debugbar()->info("sort:$sort");
                if (str_contains($this->sortField, '.')){

                    $config = collect($this->columns)->firstWhere('field', $this->sortField);
                    debugbar()->info($this->columns);
                    debugbar()->info("s".$this->sortField);

                    $q->leftJoin(
                        $config['table'],                 // roles
                        $config['table'] . '.id',         // roles.id
                        '=',
                        $table . '.' . $config['foreign_key']
                    )
                        ->orderBy(
                         $config['table'] . '.' . explode('.', $this->sortField)[1]
                        ,$this->sortAsc ? 'asc' : 'desc'
                        )
                        ->select($table . '.*');
                    return;
                }
                $q->orderBy($sort, $this->sortAsc ? 'asc' : 'desc');
            });

        return view('livewire.admin.components.table',
            ['rows' => $query->orderByDesc('created_at')->paginate($this->limit)]);
    }
}
