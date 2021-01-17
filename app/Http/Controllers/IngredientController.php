<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\Allergen;
use App\Http\Requests\IngredientStoreRequest;
use App\Http\Requests\IngredientUpdateRequest;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if(\auth()->user()->can('create:ingredients')){
            $categories = Category::all();
			$allergens = Allergen::all();
			return view('configs.ingredients.create', compact(['categories', 'allergens']));
        }
        abort(403);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngredientStoreRequest $request)
    {
		if(\auth()->user()->can('create:ingredients')){
			$ingredient = Ingredient::create($request->all());
			$ingredient->allergens()->attach($request->get('substances'));
			return redirect()->route('configs.ingredients.index');
        }
        abort(403);    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
      	if(\auth()->user()->can('edit:ingredients')){
		    $categories = Category::all();
			$allergens = Allergen::all();
			return view('configs.ingredients.edit', compact(['ingredient', 'categories', 'allergens']));
        }
        abort(403);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(IngredientUpdateRequest $request, Ingredient $ingredient)
    {
        if(\auth()->user()->can('edit:ingredients')){
			$ingredient->update($request->all());
			$ingredient->allergens()->sync($request->get('substances'));
			return redirect()->route('configs.ingredients.index');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        //
    }
}
