<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.new_dishe') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('messages.back') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Receta</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Información de la receta, verá todos los detalles que contiene el plato, ingredientes a su vez los alergenos que este contiene.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
						<!-- This example requires Tailwind CSS v2.0+ -->
						<div class="bg-white shadow overflow-hidden sm:rounded-lg">							
						  <div class="flex justify-between py-5 sm:px-6">
							  <div class="flex">
								  <div class="rounded-full w-12 h-12 cursor-pointer">
									  <img src="{{ \Illuminate\Support\Facades\Storage::url($dishe->meal->icon) }}" title="{{ $dishe->meal->name }}" alt="{{ $dishe->meal->name }}"/>
								  </div>
								  <div class="ml-4">
									    <h3 class="text-lg leading-6 font-medium text-gray-900">
									  {{ $dishe->name }}
									</h3>
									<p class="mt-1 max-w-2xl text-sm text-gray-500">
										<strong>{{ $dishe->user->name }}</strong>							  
									</p>
								  </div>								
							  </div>							
							  <div class="flex">
									@foreach($dishe->allergens() as $allergen)
										<div class="rounded-full ml-1 bg-gray-300 p-1 w-8 h-8 cursor-pointer">
											<img src="{{ \Illuminate\Support\Facades\Storage::url($allergen->icon) }}" title="{{ $allergen->name }}" alt="{{ $allergen->name }}"/>
										</div>
                                	@endforeach
								</div>
						  </div>
						  <div class="border-t border-gray-200">
							<dl>		
								<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
								<dt class="text-sm font-medium text-gray-500">
								  {{ __('messages.meal') }}
								</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
								  {{ $dishe->meal->name }}
								</dd>
							  </div>
							<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
								<dt class="text-sm font-medium text-gray-500">
								  {{ __('messages.description') }}
								</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
								  {{ $dishe->description }}
								</dd>
							  </div>
							  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
								<dt class="text-sm font-medium text-gray-500">
								  {{ __('messages.ingredients') }}
								</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
								  <ul class="rounded-md divide-y divide-gray-200">
									@foreach($dishe->ingredients as $ingredient)
										<li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
											<div class="w-0 flex-1 flex items-center">
											<!-- Heroicon name: paper-clip -->
											<img class="flex-shrink-0 h-5 w-5 text-gray-400" src="{{ \Illuminate\Support\Facades\Storage::url($ingredient->category->icon) }}" />	
											<span class="ml-2 flex-1 w-0 truncate">
											  {{ $ingredient->name }}
												<p class="max-w-2xl text-sm text-gray-500">
													{{ $ingredient->description }}							  
												</p>
											</span>
										  </div>
										  <div class="ml-4 flex-shrink-0">
											@foreach($ingredient->allergens as $allergen)
                                                <div class="rounded-full ml-1 bg-gray-300 p-1 w-6 h-6 cursor-pointer">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($allergen->icon) }}" title="{{ $allergen->name }}" alt="{{ $allergen->name }}"/>
                                                </div>
                                            @endforeach
										  </div>
										</li>
									@endforeach								  									
								  </ul>
								</dd>
							  </div>
								<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
								<dt class="text-sm font-medium text-gray-500">
								  {{ __('messages.published') }}
								</dt>
								<dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
								  {{  $dishe->created_at->format('M d, Y') }}
								</dd>
							  </div>
							</dl>
						  </div>
						<div class="bg-white px-4 py-3 text-right border-t border-gray-200 sm:px-6">
                            @can('edit:dishes')							
								<a href="{{ route('cookbook.dishes.edit', $dishe->slug) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
									{{ __('messages.edit') }}
								</a>
							@endcan
                        </div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>