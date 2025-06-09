<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-3xl text-[#ac2358] leading-tight drop-shadow-lg">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-[#fff0f4] to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <!-- Monedas -->
                <div class="bg-white/90 rounded-3xl shadow-xl p-8 border border-[#ffd6e0] flex flex-col items-center animate-fadeInUp">
                    <div class="flex items-center mb-4">
                        <span class="text-4xl bg-[#ffd6e0] text-[#ac2358] p-4 rounded-full shadow">🪙</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#ac2358] mb-1">Monedas</h3>
                    <p class="text-3xl font-extrabold text-[#ac2358]">{{ Auth::user()->coins_balance }}</p>
                </div>

                <!-- Recetas -->
                <div class="bg-white/90 rounded-3xl shadow-xl p-8 border border-[#ffd6e0] flex flex-col items-center animate-fadeInUp">
                    <div class="flex items-center mb-4">
                        <span class="bg-[#ffd6e0] text-[#ac2358] p-4 rounded-full shadow">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-[#ac2358] mb-1">Mis Recetas</h3>
                    <p class="text-3xl font-extrabold text-[#ac2358]">{{ Auth::user()->recipes()->count() }}</p>
                </div>

                <!-- Comentarios -->
                <div class="bg-white/90 rounded-3xl shadow-xl p-8 border border-[#ffd6e0] flex flex-col items-center animate-fadeInUp">
                    <div class="flex items-center mb-4">
                        <span class="bg-[#ffd6e0] text-[#ac2358] p-4 rounded-full shadow">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-[#ac2358] mb-1">Comentarios</h3>
                    <p class="text-3xl font-extrabold text-[#ac2358]">{{ Auth::user()->comments()->count() }}</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white/90 rounded-3xl shadow-xl p-8 border border-[#ffd6e0] mb-10 animate-fadeInUp">
                <h3 class="text-xl font-bold text-[#ac2358] mb-6">Actividad Reciente</h3>
                <div class="space-y-4">
                    @forelse(Auth::user()->notifications()->latest()->take(5)->get() as $notification)
                        <div class="flex items-start space-x-3 p-4 bg-[#fff0f4] rounded-xl">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-[#ac2358]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-base text-[#7a1330]">{{ $notification->data['message'] ?? 'Nueva notificación' }}</p>
                                <p class="text-xs text-[#ac2358]">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-[#ac2358]">No hay actividad reciente</p>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions y Recetas Populares -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white/90 rounded-3xl shadow-xl p-8 border border-[#ffd6e0] animate-fadeInUp">
                    <h3 class="text-xl font-bold text-[#ac2358] mb-6">Acciones Rápidas</h3>
                    <div class="space-y-4">
                        <a href="{{ route('recipes.create') }}" class="block w-full px-6 py-3 text-center text-lg font-bold text-white bg-[#ac2358] hover:bg-[#7a1330] rounded-full shadow-lg transition">
                            Crear Nueva Receta
                        </a>
                        <a href="{{ route('shop.index') }}" class="block w-full px-6 py-3 text-center text-lg font-bold text-[#ac2358] bg-[#ffd6e0] hover:bg-[#fff0f4] rounded-full shadow-lg transition border-2 border-[#ac2358]">
                            Visitar Tienda
                        </a>
                        <a href="{{ route('chat.index') }}" class="block w-full px-6 py-3 text-center text-lg font-bold text-[#7a1330] bg-[#fff0f4] hover:bg-[#ffd6e0] rounded-full shadow-lg transition border-2 border-[#ac2358]">
                            Ver mis chats
                        </a>
                    </div>
                </div>

                <div class="bg-white/90 rounded-3xl shadow-xl p-8 border border-[#ffd6e0] animate-fadeInUp">
                    <h3 class="text-xl font-bold text-[#ac2358] mb-6">Recetas Populares</h3>
                    <div class="space-y-4">
                        @forelse(\App\Models\Recipe::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get() as $recipe)
                            <a href="{{ route('recipes.show', $recipe) }}" class="block p-4 bg-[#fff0f4] rounded-xl hover:bg-[#ffd6e0] transition">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="w-16 h-16 rounded-xl object-cover">
                                    <div>
                                        <h4 class="text-lg font-bold text-[#ac2358]">{{ $recipe->title }}</h4>
                                        <p class="text-xs text-[#7a1330]">{{ $recipe->likes_count }} me gusta</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-[#ac2358]">No hay recetas populares</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .animate-fadeInUp {
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
    </style>
</x-app-layout>