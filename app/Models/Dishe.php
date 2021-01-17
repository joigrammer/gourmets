<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dishe extends Model
{
    use HasFactory;
	use SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'meal_id', 'user_id'
    ];
	
	public function allergens()
	{
		return $this->ingredients()->whereHas('allergens')
			->join('allergen_ingredient', 'ingredients.id', '=', 'allergen_ingredient.ingredient_id')
			->join('allergens', 'allergens.id', '=', 'allergen_ingredient.allergen_id')
			->get(['allergens.name', 'allergens.icon']);
	}
	
	public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
	
	public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
