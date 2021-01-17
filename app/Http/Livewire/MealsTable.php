<?php

namespace App\Http\Livewire;

use App\Models\Meal;
use Livewire\Component;
use Livewire\WithPagination;

class MealsTable extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';

    public function remove(Meal $meal)
    {
		if(\auth()->user()->can('delete:meals')){
        	$meal->delete();
		}
    }

    public function render()
    {
        return view('livewire.meals-table', [
            'meals' => Meal::where('name', 'LIKE', "%{$this->search}%")
                ->paginate(15)
        ]);
    }
}