<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
		$faker = \Faker\Factory::create();
		$faker->addProvider(new \Bezhanov\Faker\Provider\Food($faker));
		$name = $faker->unique(true)->ingredient;
        return [
            'name' => $name,
			'slug' => Str::slug($name, '-'),
			'description' => $faker->paragraph(1),
			'category_id' => $faker->numberBetween(1, 12),
        ];
    }
}
