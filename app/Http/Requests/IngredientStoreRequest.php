<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IngredientStoreRequest extends FormRequest
{
	public function __construct(Request $request)
    {
        $request['slug'] = Str::slug($request->get('name'));
    }
	
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:ingredients',
            'slug' => 'required|unique:categories',
            'category_id' => 'required|exists:categories,id',
            'substances.*' => 'exists:allergens,id'
        ];
    }
}
