<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Meal;
use App\Models\Category;
use App\Models\Ingredient;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EditDishe extends Component
{
	public $dishe;
	
	public $name;
	public $slug;
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
	
	public function submit()
	{
		$this->slug = Str::slug($this->name);
        $data = $this->validate([
            'name' => 'required|min:3|max:128',
            'slug' => [
                Rule::unique('dishes')->ignore($this->slug, 'slug'),
            ],
            'description' => 'required|min:3|max:255',
            'meal_id' => 'required|exists:meals,id',
        ]);		
        $ingredients = collect();
        foreach ($this->recipe as $ingredient){
            $ingredients->push($ingredient['id']);
        }
        $this->dishe->fill($data);
        $this->dishe->ingredients()->sync($ingredients);
		$this->dishe->save();
        return redirect()->route('dashboard');
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
	
	public function remove($ingredient)
    {
        unset($this->recipe[$ingredient]);
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
