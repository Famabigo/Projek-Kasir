<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Market - @yield('title', 'Dashboard')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Icons (Heroicons via CDN for quick implementation) -->
        <script src="https://cdn.jsdelivr.net/npm/@heroicons/vue@2.0.18/24/outline/index.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            .bg-primary { background-color: #0C5587; }
            .bg-secondary { background-color: #C7E339; }
            .bg-accent { background-color: #0884D1; }
            .bg-light { background-color: #F9FAFB; }
            .text-primary { color: #0C5587; }
            .text-accent { color: #0884D1; }
            .border-primary { border-color: #0C5587; }
            .hover-lift { transition: transform 0.2s ease; }
            .hover-lift:hover { transform: translateY(-2px); }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50"
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Main Content -->
            <main>
                <!-- Page Content -->
                <div class="py-6">
                    @if(session('success'))
                        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 mb-6">
                            <div class="p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
