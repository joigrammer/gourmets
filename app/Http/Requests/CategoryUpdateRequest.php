<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
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
        $slug = $this->request->get('slug');
        return [
            'name' => 'required',
            'slug' => [
                Rule::unique('categories')->ignore($slug, 'slug'),
            ],
            'icon' => 'mimes:png,jpg,svg|max:1024'
        ];
    }
}
