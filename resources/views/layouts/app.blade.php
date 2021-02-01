<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
		
		@stack('styles-css')
        @livewireStyles		
		
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- App Settings -->
            @can('app:setting')
                <div class="mx-full bg-gray-800 " style="background: #ffbc68">
                    <div class="flex justify-between bg-indi max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8" style="background: #ffbc68">
                        <div class="text-left text-xs font-medium text-white uppercase">
                            {{ __('messages.configs') }}
                        </div>
							<div class="flex gap-4">
								<div class="text-left text-xs font-medium text-white uppercase">
									<a href="{{ route('configs.categories.index') }}">
										{{ __('messages.categories') }}
									</a>
								</div>
								<div class="text-left text-xs font-medium text-white uppercase">
									<a href="{{ route('configs.ingredients.index') }}">
										{{ __('messages.ingredients') }}
									</a>
								</div>
								<div class="text-left text-xs font-medium text-white uppercase">
									<a href="{{ route('configs.meals.index') }}">
										{{ __('messages.meals') }}
									</a>
								</div>
						</div>                        
                    </div>
                </div>
            @endcan
			
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
		
		@stack('scripts')
    </body>
</html>
