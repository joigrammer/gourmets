<div  class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-slot name="header">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('messages.categories') }}
                    </h2>
                    @can('create:categories')
                        <a href="{{ route('configs.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('messages.new_category') }}
                        </a>
                    @endcan
                </div>
            </x-slot>
            <div class="flex flex-col">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                            <input
                                wire:model="search"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                type="text"
                                placeholder="{{ __('messages.search') }}">
                        </div>
                        <table class="w-full divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('messages.name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('messages.options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if(!$categories->count())
                                    <tr class="bg-white px-4 py-3 text-center border-t border-gray-200">
                                        <td colspan="2">No search results.</td>
                                    </tr>
                                @endif
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10" src="{{ \Illuminate\Support\Facades\Storage::url($category->icon) }}" alt="{{ $category->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-lg font-medium text-gray-900">
                                                        {{ $category->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $category->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @can('delete:categories')
                                                <button
                                                    wire:click="remove({{ $category->id }})"
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                                    {{ __('messages.delete') }}
                                                </button>
                                            @endcan

                                            @can('edit:categories')
                                                <a href="{{ route('configs.categories.edit', $category->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                                    {{ __('messages.edit') }}
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>