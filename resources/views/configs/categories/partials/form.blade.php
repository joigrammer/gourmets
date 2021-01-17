<div class="grid grid-cols-7 gap-6">
    <div class="col-span-12">
        <label for="name" class="block text-sm font-medium text-gray-700">{{ __('messages.name') }}</label>
        <input type="text" name="name" id="name" class="form-input mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('name', isset($category->name) ? $category->name : null) }}">
        @error('name')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="col-span-12">
        <label for="description" class="block text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
        <textarea id="description" name="description" rows="3" class="form-input shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="">{{ old('description', isset($category->description) ? $category->description : null) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="col-span-12">
        <label class="block text-sm font-medium text-gray-700">
            {{ __('messages.icon') }}
        </label>
        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                    <label for="icon" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>Upload a file</span>
                        <input id="icon" name="icon" type="file" class="sr-only" value="{{ old('icon', isset($category->icon) ? $category->icon : null) }}">
                    </label>
                </div>
                <p class="text-xs text-gray-500">
                    PNG, JPG, SVG up to 1MB
                </p>
            </div>
        </div>
        @error('icon')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror
    </div>
</div>