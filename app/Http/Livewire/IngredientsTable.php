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
	public $show;
	
	public function restore($ingredient)
	{
		if(\auth()->user()->can('restore:ingredients')){
        	Ingredient::withTrashed()->where('id', $ingredient)->restore();
		}
	}
	
    public function remove(Ingredient $ingredient)
    {
		if(\auth()->user()->can('delete:ingredients')){
        	$ingredient->delete();
		}
    }	

    public function render()
    {
		if($this->show){
			$ingredients = Ingredient::onlyTrashed()->paginate(10);
		}else{
			$ingredients = Ingredient::where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%")
                ->paginate(10);
		}
        return view('livewire.ingredients-table', [
            'ingredients' => $ingredients
        ]);
    }
}