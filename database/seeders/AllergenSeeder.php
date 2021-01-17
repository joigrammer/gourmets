<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Allergen;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Gluten',
                'slug' => 'gluten',
                'icon' => 'public/assets/icons/allergens/gluten.svg'
            ],
            [
                'name' => 'Peanuts',
                'slug' => 'peanuts',
                'icon' => 'public/assets/icons/allergens/peanuts.svg'
            ],
            [
                'name' => 'Tree Nuts',
                'slug' => 'tree-nuts',
                'icon' => 'public/assets/icons/allergens/tree-nuts.svg'
            ],
            [
                'name' => 'Celery',
                'slug' => 'celery',
                'icon' => 'public/assets/icons/allergens/celery.svg'
            ],
            [
                'name' => 'Mustard',
                'slug' => 'mustard',
                'icon' => 'public/assets/icons/allergens/mustard.svg'
            ],
            [
                'name' => 'Eggs',
                'slug' => 'eggs',
                'icon' => 'public/assets/icons/allergens/eggs.svg'
            ],
            [
                'name' => 'Milk',
                'slug' => 'milk',
                'icon' => 'public/assets/icons/allergens/milk.svg'
            ],
            [
                'name' => 'Sesame',
                'slug' => 'sesame',
                'icon' => 'public/assets/icons/allergens/sesame.svg'
            ],
            [
                'name' => 'Fish',
                'slug' => 'fish',
                'icon' => 'public/assets/icons/allergens/fish.svg'
            ],
            [
                'name' => 'Crustaceans',
                'slug' => 'crustaceans',
                'icon' => 'public/assets/icons/allergens/crustaceans.svg'
            ],
            [
                'name' => 'Molluscs',
                'slug' => 'molluscs',
                'icon' => 'public/assets/icons/allergens/molluscs.svg'
            ],
            [
                'name' => 'Soya',
                'slug' => 'soya',
                'icon' => 'public/assets/icons/allergens/soya.svg'
            ],
            [
                'name' => 'Sulphites',
                'slug' => 'sulphites',
                'icon' => 'public/assets/icons/allergens/sulphites.svg'
            ],
            [
                'name' => 'Lupin',
                'slug' => 'lupin',
                'icon' => 'public/assets/icons/allergens/lupin.svg'
            ],
        ];
        Allergen::insert($data);
    }
}
