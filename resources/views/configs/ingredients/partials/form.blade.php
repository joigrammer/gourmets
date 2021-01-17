<div class="grid grid-cols-7 gap-6">
    <div class="col-span-12">
        <label for="name" class="block text-sm font-medium text-gray-700">
            {{ __('messages.name') }}
        </label>
        <input type="text" name="name" id="name" class="form-input mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('name', isset($ingredient->name) ? $ingredient->name : null) }}">
        @error('name')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="col-span-12">
        <label for="description" class="block text-sm font-medium text-gray-700">
            {{ __('messages.description') }}
        </label>
        <textarea id="description" name="description" rows="3" class="form-input shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">{{ old('description', isset($ingredient->description) ? $ingredient->description : null) }}</textarea>
        @error('description')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>

    <div class="col-span-12">
        <label id="category_id" class="text-gray-700">
            {{ __('messages.category') }}
        </label>
        <select id="category_id" name="category_id" class="form-input shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
            <option selected>Choose category...</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', isset($category->name) ? 'selected' : null) }}>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="col-span-12">
        <h3 class="mb-2 text-gray-700">{{ __('messages.allergens') }}</h3>
        @if(isset($ingredient))
            @foreach($allergens as $key => $allergen)
                @foreach($ingredient->allergens as $key => $substance)
                    @if($substance->slug == $allergen->slug)
                        <input id="{{ $substance->slug }}" name="substances[]" value="{{ $substance->id }}" type="checkbox" checked/>
                        <label for="{{ $substance->slug }}" class="cursor-pointer">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($substance->icon) }}" title="{{ $substance->name }}" alt="{{ $substance->name }}"/>
                        </label>
                        @break
                    @endif
                @endforeach
                <input id="{{ $allergen->slug }}" name="substances[]" value="{{ $allergen->id }}" type="checkbox"/>
                <label for="{{ $allergen->slug }}" class="cursor-pointer">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($allergen->icon) }}" title="{{ $allergen->name }}" alt="{{ $allergen->name }}"/>
                </label>
            @endforeach
        @else
            @foreach($allergens as $allergen)
                <input id="{{ $allergen->slug }}" name="substances[]" value="{{ $allergen->id }}" class="text-center" type="checkbox"/>
                <label for="{{ $allergen->slug }}" class="cursor-pointer">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($allergen->icon) }}" title="{{ $allergen->name }}" alt="{{ $allergen->name }}"/>
                </label>
            @endforeach
        @endif
    </div>
</div>