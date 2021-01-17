<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Meal;
use App\Models\Category;
use App\Models\Ingredient;

class EditDishe extends Component
{
	public $dishe;
	
	public $name;
	public $description;
	
	public $meal_id;
	public $category_id;
	public $ingredient_id;
	
	public $ingredients = [];
	public $recipe = [];
	
	public function mount()
	{
		$this->name = $this->dishe->name;
		$this->description = $this->dishe->description;
		$this->meal_id = $this->dishe->meal->id;
		foreach($this->dishe->ingredients as $ingredient){
			$this->recipe[] = array(
                'id' => $ingredient->id,
                'slug' => $ingredient->slug,
                'name' => $ingredient->name,
                'category' => [
                    'name' => $ingredient->category->name,
                    'icon' => $ingredient->category->icon,
                ],
                'allergens' => $ingredient->allergens
            );
		}
	}
	
	public function addIngredient()
    {
        if(!empty($this->ingredient_id)){
            $ingredient = Ingredient::find($this->ingredient_id);
            $this->recipe[] = array(
                'id' => $ingredient->id,
                'slug' => $ingredient->slug,
                'name' => $ingredient->name,
                'category' => [
                    'name' => $ingredient->category->name,
                    'icon' => $ingredient->category->icon,
                ],
                'allergens' => $ingredient->allergens
            );
        }

    }
	
    public function render()
    {
		if(!empty($this->category_id)){
            $this->ingredients = Category::find($this->category_id)->ingredients;

        }
		
        return view('livewire.edit-dishe', [
			'meals' => Meal::all(),
			'categories' => Category::all()
		]);
    }
}
