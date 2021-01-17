<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MealStoreRequest;
use App\Models\Meal;

class MealController extends Controller
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
        if(\auth()->user()->can('create:meals')){
            return view('configs.meals.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealStoreRequest $request)
    {
		if(\auth()->user()->can('create:meals')){
			$data = $request->all();
            $data['icon'] = $request->file('icon')->store('public/assets/icons/meals');
        	Meal::create($data);
			return redirect()->route('configs.meals.index');
		}
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        if(\auth()->user()->can('edit:meals')){
			return view('configs.meals.edit', compact('meal'));
		}
		abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        if(\auth()->user()->can('edit:meals')){
			$data = $request->all();
            if($request->hasFile('icon')){
                Storage::delete($meal->icon);
                $data['icon'] = $request->file('icon')->store('public/assets/icons/meals');
            }
            $meal->fill($data);
            $meal->save();
			return redirect()->route('configs.meals.index');
		}
		abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
