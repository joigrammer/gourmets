<?php

namespace App\Http\Livewire;

use App\Models\Ingredient;
use Livewire\Component;
use Livewire\WithPagination;

class IngredientsTable extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';

    public function remove(Ingredient $ingredient)
    {
		if(\auth()->user()->can('delete:ingredients')){
        	$ingredient->delete();
		}
    }

    public function render()
    {
        return view('livewire.ingredients-table', [
            'ingredients' => Ingredient::where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%")
                ->paginate(15)
        ]);
    }
}