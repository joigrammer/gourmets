@push('styles-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/allergens.css') }}">
@endpush
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.ingredients') }}
            </h2>
            <a href="{{ route('configs.ingredients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('messages.ingredients') }}</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            El ingrediente es parte esencial de una receta, asigne un nombre al ingrediente con una breve explicación de lo que conlleva.
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            Es importante la selección de una categoría que se asocie a dicho ingrediente como también la selección de los alergenos que este pueda contener.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form
                        action="{{ route('configs.ingredients.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        >
                        @csrf
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                @include('configs.ingredients.partials.form')
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-jet-button>
                                    {{ __('messages.create') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>