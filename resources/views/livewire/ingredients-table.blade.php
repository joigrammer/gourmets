@push('styles-css')
	<link rel="stylesheet" href="{{ asset('/css/visibility.css') }}">
@endpush
<div  class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-slot name="header">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('messages.ingredients') }}
                    </h2>
                    @can('create:ingredients')
                        <a href="{{ route('configs.ingredients.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('messages.new_ingredient') }}
                        </a>
                    @endcan
                </div>
            </x-slot>
            <div class="flex flex-col">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                            <input wire:model="search"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                type="text"
                                placeholder="{{ __('messages.search') }}">
							@can('restore:ingredients')
								<input id="visibility" wire:model="show" class="visibility" type="checkbox"/>
								<label for="visibility" class="ml-3"></label>		
							@endcan							
                        </div>
                        <table class="w-full divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('messages.name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('messages.options') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if(!$ingredients->count())
                                    <tr class="bg-white px-4 py-3 text-center border-t border-gray-200">
                                        <td colspan="2">No search results.</td>
                                    </tr>
                                @endif
                                @foreach($ingredients as $ingredient)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10" src="{{ \Illuminate\Support\Facades\Storage::url($ingredient->category->icon) }}" alt="{{ $ingredient->category->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-lg font-medium text-gray-900">
                                                        {{ $ingredient->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $ingredient->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="flex justify-end px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
											<div class="flex mr-4">
												@foreach($ingredient->allergens as $allergen)
													<div class="rounded-full mx-1 bg-gray-300 p-1 w-9 h-9 cursor-pointer">
														<img src="{{ \Illuminate\Support\Facades\Storage::url($allergen->icon) }}" title="{{ $allergen->name }}" alt="{{ $allergen->name }}"/>
													</div>
                                            	@endforeach
											</div>
											<div class="flex gap-1">
												@if($ingredient->trashed())
													<button wire:click="restore({{ $ingredient->id }})"
															class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
														{{ __('messages.restore') }}
													</button>
												@else
													@can('delete:ingredients')
														<button wire:click="remove({{ $ingredient->id }})"
															class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
															{{ __('messages.delete') }}
														</button>
													@endcan
													@can('edit:ingredients')
														<a href="{{ route('configs.ingredients.edit', $ingredient->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
															{{ __('messages.edit') }}
														</a>
												@endcan
												@endif																
											</div>                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                            {{ $ingredients->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>