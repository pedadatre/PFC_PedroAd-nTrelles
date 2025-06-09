<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-[#fbe4ec] via-[#fff0f6] to-[#fbe4ec] py-10 px-2 md:px-0">
        <!-- Tarjeta de Usuario -->
        <div class="max-w-3xl mx-auto bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl p-8 mb-10 border-2 border-[#ac2358]">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="relative flex-shrink-0">
                    @if($user->activeAvatar)
                        <span class="text-7xl">{{ $user->activeAvatar->icon }}</span>
                    @else
                        <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                             alt="{{ $user->name }}"
                             class="w-32 h-32 rounded-full border-4 border-[#ac2358] shadow-lg object-cover bg-white transition hover:scale-105">
                    @endif
                </div>
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                        <h1 class="text-3xl font-extrabold text-[#ac2358] leading-tight">{{ $user->name }}</h1>
                        @if($user->activeBadge)
                            <span class="text-3xl ml-2" title="{{ $user->activeBadge->name }}">
                                {{ $user->activeBadge->icon }}
                            </span>
                        @endif
                    </div>
                    @if($user->title)
                        <p class="text-[#7a1330] font-semibold">{{ $user->title }}</p>
                    @endif
                    <p class="text-gray-500 mt-1">Miembro desde <span class="font-semibold">{{ $user->created_at->format('M Y') }}</span></p>
                    <div class="flex flex-wrap gap-2 mt-4">
                        @auth
                            @if(Auth::id() === $user->id)
                                <a href="{{ route('shop.inventory') }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold px-4 py-2 rounded-xl shadow transition">
                                    Inventario
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                   class="bg-[#ac2358] hover:bg-[#7a1330] text-white font-bold px-4 py-2 rounded-xl shadow transition">
                                    Editar Perfil
                                </a>
                            @endif
                        @endauth
                        @if(Auth::id() !== $user->id)
                            <a href="{{ route('messages.show', $user) }}"
                               class="inline-flex items-center px-4 py-2 bg-[#ac2358] text-white rounded-xl font-bold shadow hover:bg-[#7a1330] transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                                Enviar mensaje
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas y Logros -->
        <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <!-- Estadísticas -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-[#f7b6d2]">
                <h2 class="text-xl font-bold mb-4 text-[#ac2358]">Estadísticas</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <p class="text-4xl font-extrabold text-[#ac2358]">{{ $user->recipes->count() }}</p>
                        <p class="text-gray-600">Recetas</p>
                    </div>
                    <div class="text-center">
                        <p class="text-4xl font-extrabold text-[#ac2358]">{{ $totalLikes }}</p>
                        <p class="text-gray-600">Me gusta</p>
                    </div>
                </div>
            </div>
            <!-- Logros -->
            <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 border border-[#f7b6d2]">
                <h2 class="text-xl font-bold mb-4 text-[#ac2358]">Logros</h2>
                <div class="flex flex-wrap gap-3">
                    @forelse($user->achievements as $achievement)
                        <div class="flex items-center gap-2 px-3 py-2 bg-[#fbe4ec] border border-[#ac2358] rounded-xl shadow-sm">
                            <img src="{{ $achievement->icon_url }}" alt="{{ $achievement->name }}" class="w-8 h-8">
                            <span class="font-semibold text-[#7a1330]">{{ $achievement->name }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-2">Aún no hay logros desbloqueados</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recetas del Usuario -->
        <div class="max-w-5xl mx-auto bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-8 border border-[#f7b6d2]">
            <h2 class="text-2xl font-extrabold mb-6 text-[#ac2358]">Recetas de {{ $user->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($user->recipes as $recipe)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-[#f7b6d2] hover:scale-105 transition-transform duration-300">
                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="w-full h-44 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2 text-[#ac2358]">{{ $recipe->title }}</h3>
                            <p class="text-gray-600 mb-4 min-h-[48px]">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-4 text-[#ac2358]">
                                    <span>❤️ {{ $recipe->likes_count }}</span>
                                    <span>💬 {{ $recipe->comments_count }}</span>
                                </div>
                                <a href="{{ route('recipes.show', $recipe) }}"
                                   class="text-[#ac2358] hover:text-[#7a1330] font-bold underline transition">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-3 text-center">Este usuario aún no ha publicado recetas</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>