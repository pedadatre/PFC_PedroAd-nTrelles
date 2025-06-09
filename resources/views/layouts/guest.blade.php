<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .animate-fade-in-up {
                animation: fadeInUp 0.8s cubic-bezier(0.39, 0.575, 0.565, 1) both;
            }
            @keyframes fadeInUp {
                0% {
                    opacity: 0;
                    transform: translateY(40px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-bounce-slow {
                animation: bounce 2.5s infinite;
            }
            @keyframes bounce {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-10px);
                }
            }
        </style>
        
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="flex items-center justify-center py-22 bg-gradient-to-br from-white to-gastro-50">
            <div class="w-full max-w-4xl mx-auto">
                <!-- Contenedor del contenido -->
                <div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
