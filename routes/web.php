<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get(
	'/cookbook', [\App\Http\Controllers\DisheController::class, 'index']
)->name('dashboard');

Route::prefix('configs')->group(function () {
    Route::name('configs.')->group(function () {
        Route::get('categories', \App\Http\Livewire\CategoriesTable::class)->name('categories.index');
        Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except(
            'index', 'delete'
        ); 
		Route::get('ingredients', \App\Http\Livewire\IngredientsTable::class)->name('ingredients.index');
		Route::resource('ingredients', \App\Http\Controllers\IngredientController::class)->except(
            'index', 'delete'
        ); 
		Route::get('meals', \App\Http\Livewire\MealsTable::class)->name('meals.index');
		Route::resource('meals', \App\Http\Controllers\MealController::class)->except(
            'index', 'delete'
        ); 
    });
});

Route::prefix('cookbook')->group(function () {
    Route::name('cookbook.')->group(function () {
        Route::resource('dishes', \App\Http\Controllers\DisheController::class)->except(
            'index', 'edit', 'update'
        );
		Route::get(
			'dishes/{slug}/edit', 
			[\App\Http\Controllers\DisheController::class, 'edit']
		)->name('dishes.edit');
    });
});