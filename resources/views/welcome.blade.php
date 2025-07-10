<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Prevent search engine indexing - Internal system only -->
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="bingbot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="slurp" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="duckduckbot" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    
    <!-- Prevent social media crawling -->
    <meta property="og:title" content="Internal System - Access Restricted">
    <meta property="og:description" content="This is an internal business system.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Internal System - Access Restricted">
    <meta name="twitter:description" content="This is an internal business system.">

    <title>{{ config('app.name', 'Erle') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom styles for welcome page */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Apply dark mode styles */
        .dark body {
            background-color: #111827;
            color: #f3f4f6;
        }

        /* Additional custom styles can be added here */
    </style>
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col justify-center">
        <main class="flex flex-col lg:flex-row w-full max-w-7xl mx-auto overflow-hidden shadow-xl rounded-xl">
            <!-- Left Panel - Image -->
            <div class="hidden lg:block w-1/2 relative overflow-hidden bg-indigo-900">
                <!-- Background image with full cover -->
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/erle-welcome.png'); filter: brightness(0.85);"></div>
                

            </div>
            
            <!-- Right Panel - Login Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-12 bg-white dark:bg-gray-800">
                <!-- Logo & Welcome -->
                <div class="mb-8">
                    <div class="flex items-center space-x-2 mb-6">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-xl font-bold text-gray-900 dark:text-white">{{ __('welcome.title') }}</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ __('welcome.welcome_back') }}</h1>
                    <p class="text-gray-500 dark:text-gray-400">{{ __('welcome.login_description') }}</p>
                </div>
                
                <!-- Login Button -->
                <div class="flex-1">
                    <div class="space-y-6">
                        <div class="text-center">
                            <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('welcome.login_instruction') }}</p>
                            <a href="{{ route('filament.app.auth.login') }}" class="inline-flex items-center justify-center w-full bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-600 text-white font-medium py-3 px-4 rounded-lg transition-all duration-200">
                                {{ __('welcome.login_button') }}
                            </a>
                        </div>
                        
                        @if (Route::has('filament.app.auth.password-reset.request'))
                            <div class="text-center">
                                <a href="{{ route('filament.app.auth.password-reset.request') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">{{ __('welcome.forgot_password') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-800">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} Wirelabs. {{ __('welcome.copyright') }}
                    </p>
                </div>
            </div>
        </main>
    </div>


</body>
</html>
