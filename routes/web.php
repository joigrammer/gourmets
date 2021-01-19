<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

Route::get('/locale/{language}', function ($language) {
	\Illuminate\Support\Facades\Session::put('locale', $language);
	return redirect()->back();
})->name('lang');

Route::group(['middleware' => 'language'], function () {
	


Route::get('/', function () {
	return redirect()->route('dashboard');
});

Route::get('/cookbook', \App\Http\Livewire\SearchDishe::class)->name('dashboard');

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
			Route::get(
			'dishe/{slug}', 
			[\App\Http\Controllers\DisheController::class, 'show']
		)->name('dishe.show');
	});
});
	
	});