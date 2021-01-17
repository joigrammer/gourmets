<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory;
	use SoftDeletes;
	
    protected $fillable = [
        'name', 'slug', 'description', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
	
	
	public function allergens()
    {
        return $this->belongsToMany(Allergen::class, 'allergen_ingredient');
    }
}
