<?php

namespace App\Http\Livewire;


use App\Models\Category;
use App\Models\Dishe;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MakeDishe extends Component
{
    public $name;
    public $slug;
    public $description;
    public $category_id;
    public $meal_id;
    public $ingredient_id;

    public $ingredients = [];
    public $recipe = [];

    public function submit()
    {
        $this->slug = Str::slug($this->name);
        $data = $this->validate([
            'name' => 'required|min:3|max:128|unique:dishes',
            'slug' => [
                Rule::unique('dishes'),
            ],
            'description' => 'required|min:3|max:255|',
            'meal_id' => 'required|exists:meals,id',
        ]);
		$data['user_id'] = Auth::user()->getAuthIdentifier();
        $ingredients = collect();
        foreach ($this->recipe as $ingredient){
            $ingredients->push($ingredient['id']);
        }
        $dishe = Dishe::create($data);
        $dishe->ingredients()->attach($ingredients);
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
		$this->emit('refreshDropdown');
        if(!empty($this->category_id)){
            $this->ingredients = Category::find($this->category_id)->ingredients;

        }

        return view('livewire.make-dishe', [
            'meals' => Meal::all(),
            'categories' => Category::all()
        ]);
    }
}