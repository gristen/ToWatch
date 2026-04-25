<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class Search extends Component
{
    public string $search = '';
    public string $handler;
    public array $searchColumns;
    public ?string $subField = null;

    public $displayField;
    public function render()
    {
       debugbar()->info($this->search);
       $query = $this->handler::query()
            ->when($this->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->search($search, $this->searchColumns);
                });
            });
        debugbar()->info($query->paginate(10));
        return view('livewire.admin.components.search',[
            'rows' => $query->paginate(10)
        ]);
    }
}
