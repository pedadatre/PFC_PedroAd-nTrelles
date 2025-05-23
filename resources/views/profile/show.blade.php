<x-app-layout>
    <div class="container mx-auto px-4 py-8">
       <!-- Información del Usuario -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-8">
    <div class="flex items-center space-x-4">
        <div class="relative">
            @if($user->activeAvatar)
                <span class="text-4xl">{{ $user->activeAvatar->icon }}</span>
            @else
                <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                     alt="{{ $user->name }}" 
                     class="w-24 h-24 rounded-full">
            @endif
        </div>
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                @if($user->activeBadge)
                    <span class="text-2xl" title="{{ $user->activeBadge->name }}">
                        {{ $user->activeBadge->icon }}
                    </span>
                @endif
            </div>
            @if($user->title)
                <p class="text-indigo-600">{{ $user->title }}</p>
            @endif
            <p class="text-gray-600">Miembro desde {{ $user->created_at->format('M Y') }}</p>
        </div>
        @auth
            @if(Auth::id() === $user->id)
                <div class="ml-auto space-x-2">
                    <a href="{{ route('shop.inventory') }}" 
                       class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                        Inventario
                    </a>
                    <a href="{{ route('profile.edit') }}" 
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        Editar Perfil
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>

        <!-- Estadísticas y Logros -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Estadísticas -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold mb-4">Estadísticas</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-indigo-600">{{ $user->recipes->count() }}</p>
                        <p class="text-gray-600">Recetas</p>
                    </div>
                    <div class="text-center">
                        <p class="text-3xl font-bold text-indigo-600">{{ $totalLikes }}</p>
                        <p class="text-gray-600">Me gusta</p>
                    </div>
                </div>
            </div>

            <!-- Logros -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold mb-4">Logros</h2>
                <div class="grid grid-cols-2 gap-4">
                    @forelse($user->achievements as $achievement)
                        <div class="flex items-center space-x-2">
                            <img src="{{ $achievement->icon_url }}" alt="{{ $achievement->name }}" class="w-8 h-8">
                            <span>{{ $achievement->name }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-2">Aún no hay logros desbloqueados</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recetas del Usuario -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-6">Recetas de {{ $user->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($user->recipes as $recipe)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $recipe->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-4">
                                    <span>❤️ {{ $recipe->likes_count }}</span>
                                    <span>💬 {{ $recipe->comments_count }}</span>
                                </div>
                                <a href="{{ route('recipes.show', $recipe) }}" 
                                   class="text-indigo-600 hover:underline">
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