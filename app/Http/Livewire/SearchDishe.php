<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dishe;
use Livewire\WithPagination;

class SearchDishe extends Component
{
	use WithPagination;
	
	protected $queryString = [
        'search' => ['except' => '']
    ];
	
	public $search = '';
	
    public function render()
    {
        return view('livewire.search-dishe', [
			'dishes' => Dishe::where('name', 'LIKE', "%{$this->search }%")
			->orWhere('description', 'LIKE', "%{$this->search}%")
			->simplePaginate(14),
		]);
    }
}
