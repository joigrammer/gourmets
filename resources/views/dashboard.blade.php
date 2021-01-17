<x-app-layout>
    <x-slot name="header">
    	<div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	{{ __('messages.cookbook') }}
            </h2>
            @can('create:dishes')
                <a href="{{ route('cookbook.dishes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('messages.new_dishe') }}
                </a>
            @endcan
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           	    
			<div class="grid lg:grid-cols-2 grid-flow-row gap-2">
				@foreach($dishes as $dishe)
					<div class="relative max-h-full">						
						<img class="absolute bottom-5 right-10 opacity-30 w-14" src="{{ \Illuminate\Support\Facades\Storage::url($dishe->meal->icon) }}" title="{{ $dishe->meal->name }}" alt="{{ $dishe->meal->name }}"/>
						<div class="max-w-4xl h-full px-10 py-6 bg-white rounded-lg shadow-md">
							<div class="flex justify-between items-center">
								<span class="font-light text-gray-600">{{ $dishe->created_at->format('M d, Y') }}</span>
								<div class="flex">
									@foreach($dishe->allergens() as $allergen)
										<div class="rounded-full ml-1 bg-gray-300 p-1 w-8 h-8 cursor-pointer">
											<img src="{{ \Illuminate\Support\Facades\Storage::url($allergen->icon) }}" title="{{ $allergen->name }}" alt="{{ $allergen->name }}"/>
										</div>
                                	@endforeach
									@can('edit:dishe')							
										<a href="{{ route('cookbook.dishes.edit', $dishe->slug) }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
											{{ __('messages.edit') }}
										</a>
									@endcan
								</div>
							</div>
							<div class="mt">
								<a href="#" class="text-2xl text-gray-700 font-bold hover:underline">
									{{ $dishe->name }}
								</a>
								<p class="mt-2 text-gray-600">
									{{ $dishe->description }}
								</p>
							</div>
								<div class="flex justify-between items-center mt-4">
									{{ $dishe->user->name }}
								<div>
								</div>
							</div>
						</div>
					</div>
				@endforeach               
			</div>
    	</div>        
    </div>
</x-app-layout>
