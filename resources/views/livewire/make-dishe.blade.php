<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                DISHE
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Dishe details.
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <form wire:submit.prevent="submit">
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="name">
                            <p class="mt-1 text-sm text-gray-600">
                                <strong>Slug:</strong> {{ \Illuminate\Support\Str::slug($name) }}
                            </p>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Description
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" wire:model="description"></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Meal
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <select id="meal_id" name="meal_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" wire:model="meal_id">
                                <option value="" selected>Choose  meal...</option>
                                @foreach($meals as $meal)
                                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                @endforeach
                            </select>
                            @error('meal_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Categories
                            <select id="category_id" name="category_id" class="select2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" wire:model="category_id">
                                <option value="" selected>Choose category...</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            Ingredients
                            <div class="flex">
                                <select id="ingredient_id" name="ingredient_id" class="select2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" wire:model="ingredient_id">
                                    <option value="" selected>Choose ingredient...</option>
                                    @if(!is_null($category_id))
                                        @foreach($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <button type="button" class="flex items-center justify-center ml-2" wire:click="addIngredient">
                                    <img class="w-7 h-7" src="{{ \Illuminate\Support\Facades\Storage::url('public/assets/icons/system/plus.svg') }}"/>
                                </button>
                            </div>
                            @error('ingredient_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </dd>
                    </div>
                    <div class="bg-white px-2 py-3 sm:gap-4 sm:px-6">
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                @foreach($recipe as $key => $ingredient)
                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                        <div class="w-0 flex-1 flex items-center">
                                            <img class="w-7 h-7" src="{{ \Illuminate\Support\Facades\Storage::url($ingredient['category']['icon']) }}" title="{{ $ingredient['category']['name'] }}">
                                            <span class="ml-2 flex-1 w-0 truncate">
                                                {{ $ingredient['name'] }}
                                            </span>
                                        </div>
                                        <div class="ml-4 flex">
                                            @foreach($ingredient['allergens'] as $allergen)
                                                <div class="rounded-full ml-1 bg-gray-300 p-1 w-9 h-9 cursor-pointer">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($allergen['icon']) }}" title="{{ $allergen['name'] }}" alt="{{ $allergen['name'] }}"/>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="ml-4 flex">
                                            <button
                                                wire:click="remove({{$key}})"
                                                class="w-4 h-4"
                                                type="button">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url('public/assets/icons/system/remove.svg') }}"/>
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('messages.create') }}
                        </button>
                    </div>
                </form>
            </dl>
        </div>
    </div>
</div>


<script>		
	document.addEventListener('livewire:load', function (event) {
          @this.on('refreshDropdown', function () {
              $('.select2').select2();
          });
    })
	$(document).ready(function() {
		$('#category_id').select2();
		$('#category_id').on('change', function (e) {
			@this.set('category_id', e.target.value);
		})
		$('#ingredient_id').select2();
		$('#ingredient_id').on('change', function (e) {
			@this.set('ingredient_id', e.target.value);
		})
	});
</script>