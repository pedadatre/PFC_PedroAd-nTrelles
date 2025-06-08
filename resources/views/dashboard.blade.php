<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gastro-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Monedas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-gastro-100">
                                <span class="text-2xl">🪙</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gastro-800">Monedas</h3>
                                <p class="text-2xl font-bold text-gastro-600">{{ Auth::user()->coins_balance }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recetas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-gastro-100">
                                <svg class="w-6 h-6 text-gastro-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gastro-800">Mis Recetas</h3>
                                <p class="text-2xl font-bold text-gastro-600">{{ Auth::user()->recipes()->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comentarios -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-gastro-100">
                                <svg class="w-6 h-6 text-gastro-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gastro-800">Comentarios</h3>
                                <p class="text-2xl font-bold text-gastro-600">{{ Auth::user()->comments()->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gastro-800 mb-4">Actividad Reciente</h3>
                    <div class="space-y-4">
                        @forelse(Auth::user()->notifications()->latest()->take(5)->get() as $notification)
                            <div class="flex items-start space-x-3 p-3 bg-gastro-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gastro-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gastro-800">{{ $notification->data['message'] ?? 'Nueva notificación' }}</p>
                                    <p class="text-xs text-gastro-600">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gastro-600">No hay actividad reciente</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gastro-800 mb-4">Acciones Rápidas</h3>
                        <div class="space-y-3">
                            <a href="{{ route('recipes.create') }}" class="block w-full px-4 py-2 text-center text-sm font-medium text-white bg-gastro-600 hover:bg-gastro-700 rounded-md transition duration-150 ease-in-out">
                                Crear Nueva Receta
                            </a>
                            <a href="{{ route('shop.index') }}" class="block w-full px-4 py-2 text-center text-sm font-medium text-gastro-600 bg-gastro-100 hover:bg-gastro-200 rounded-md transition duration-150 ease-in-out">
                                Visitar Tienda
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gastro-800 mb-4">Recetas Populares</h3>
                        <div class="space-y-3">
                            @forelse(\App\Models\Recipe::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get() as $recipe)
                                <a href="{{ route('recipes.show', $recipe) }}" class="block p-3 bg-gastro-50 rounded-lg hover:bg-gastro-100 transition duration-150 ease-in-out">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="w-12 h-12 rounded-lg object-cover">
                                        <div>
                                            <h4 class="text-sm font-medium text-gastro-800">{{ $recipe->title }}</h4>
                                            <p class="text-xs text-gastro-600">{{ $recipe->likes_count }} me gusta</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-gastro-600">No hay recetas populares</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>