<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg p-8 mb-8">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-bold mb-4">Bienvenido a GastroWorld</h1>
                <p class="text-xl mb-6">Descubre, comparte y aprende nuevas recetas con nuestra comunidad de amantes de la cocina.</p>
                @guest
                    <div class="space-x-4">
                        <a href="{{ route('register') }}" 
                           class="bg-white text-indigo-600 px-6 py-2 rounded-lg hover:bg-indigo-50 transition">
                            Registrarse
                        </a>
                        <a href="{{ route('login') }}" 
                           class="border border-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                            Iniciar Sesión
                        </a>
                    </div>
                @endguest
                @auth
                    <a href="{{ route('recipes.create') }}" 
                       class="bg-white text-indigo-600 px-6 py-2 rounded-lg hover:bg-indigo-50 transition inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Crear Nueva Receta
                    </a>
                @endauth
            </div>
        </div>

        <!-- Barra de Búsqueda -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <form action="{{ route('recipes.search') }}" method="GET" class="flex gap-4">
                <input type="text" 
                       name="search" 
                       placeholder="Buscar recetas..." 
                       class="flex-1 border rounded-lg px-4 py-2">
                <select name="category" class="border rounded-lg px-4 py-2">
                    <option value="">Todas las categorías</option>
                    @foreach(['Pasta', 'Postres', 'Carnes', 'Ensaladas', 'Sopas'] as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Buscar
                </button>
            </form>
        </div>

        <!-- Últimas Recetas -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Últimas Recetas</h2>
                <a href="{{ route('recipes.search') }}" 
                   class="text-indigo-600 hover:text-indigo-700 transition">
                    Ver todas →
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestRecipes as $recipe)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition">
                        <img src="{{ $recipe->image_url }}" 
                             alt="{{ $recipe->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">
                                <a href="{{ route('recipes.show', $recipe) }}" 
                                   class="hover:text-indigo-600 transition">
                                    {{ $recipe->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('profile.show', $recipe->user) }}" 
                                   class="flex items-center text-indigo-600 hover:text-indigo-700">
                                    @if($recipe->user->activeAvatar)
                                        <span class="text-2xl mr-2">{{ $recipe->user->activeAvatar->icon }}</span>
                                    @endif
                                    {{ $recipe->user->name }}
                                </a>
                                <div class="flex items-center space-x-4 text-gray-500">
                                    <span class="flex items-center">
                                        <span class="text-red-500 mr-1">❤️</span>
                                        {{ $recipe->likes->count() }}
                                    </span>
                                    <span class="flex items-center">
                                        <span class="text-gray-600 mr-1">💬</span>
                                        {{ $recipe->comments->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Recetas Populares -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Recetas Populares</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($popularRecipes as $recipe)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition">
                        <img src="{{ $recipe->image_url }}" 
                             alt="{{ $recipe->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">
                                <a href="{{ route('recipes.show', $recipe) }}" 
                                   class="hover:text-indigo-600 transition">
                                    {{ $recipe->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('profile.show', $recipe->user) }}" 
                                   class="flex items-center text-indigo-600 hover:text-indigo-700">
                                    @if($recipe->user->activeAvatar)
                                        <span class="text-2xl mr-2">{{ $recipe->user->activeAvatar->icon }}</span>
                                    @endif
                                    {{ $recipe->user->name }}
                                </a>
                                <div class="flex items-center space-x-4 text-gray-500">
                                    <span class="flex items-center">
                                        <span class="text-red-500 mr-1">❤️</span>
                                        {{ $recipe->likes_count }}
                                    </span>
                                    <span class="flex items-center">
                                        <span class="text-gray-600 mr-1">💬</span>
                                        {{ $recipe->comments_count }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        @auth
            <!-- Recetas Recomendadas -->
            @if($recommendedRecipes->isNotEmpty())
                <section>
                    <h2 class="text-2xl font-bold mb-6">Recomendado para ti</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($recommendedRecipes as $recipe)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition">
                                <img src="{{ $recipe->image_url }}" 
                                     alt="{{ $recipe->title }}" 
                                     class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h3 class="font-bold text-xl mb-2">
                                        <a href="{{ route('recipes.show', $recipe) }}" 
                                           class="hover:text-indigo-600 transition">
                                            {{ $recipe->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('profile.show', $recipe->user) }}" 
                                           class="flex items-center text-indigo-600 hover:text-indigo-700">
                                            @if($recipe->user->activeAvatar)
                                                <span class="text-2xl mr-2">{{ $recipe->user->activeAvatar->icon }}</span>
                                            @endif
                                            {{ $recipe->user->name }}
                                        </a>
                                        <div class="flex items-center space-x-4 text-gray-500">
                                            <span class="flex items-center">
                                                <span class="text-red-500 mr-1">❤️</span>
                                                {{ $recipe->likes->count() }}
                                            </span>
                                            <span class="flex items-center">
                                                <span class="text-gray-600 mr-1">💬</span>
                                                {{ $recipe->comments->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endauth
    </div>
</x-app-layout>