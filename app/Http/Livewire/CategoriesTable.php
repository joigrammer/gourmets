<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesTable extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public $search = '';

    public function remove(Category $category)
    {
		if(\auth()->user()->can('delete:categories')){
        	$category->delete();
		}
    }

    public function render()
    {
        return view('livewire.categories-table', [
            'categories' => Category::where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%")
                ->paginate(10)
        ]);
    }
}