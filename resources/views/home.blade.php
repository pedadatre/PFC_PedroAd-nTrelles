<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="bg-indigo-600 text-white rounded-lg p-8 mb-8">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-bold mb-4">Bienvenido a GastroWorld</h1>
                <p class="text-xl mb-6">Descubre, comparte y aprende nuevas recetas con nuestra comunidad de amantes de la cocina.</p>
                @guest
                    <div class="space-x-4">
                        <a href="{{ route('register') }}" 
                           class="bg-white text-indigo-600 px-6 py-2 rounded-lg hover:bg-indigo-50">
                            Registrarse
                        </a>
                        <a href="{{ route('login') }}" 
                           class="border border-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                            Iniciar Sesión
                        </a>
                    </div>
                @endguest
            </div>
        </div>

        <!-- Últimas Recetas -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Últimas Recetas</h2>
                <a href="{{ route('recipes.search') }}" class="text-indigo-600 hover:underline">Ver todas</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestRecipes as $recipe)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ $recipe->image_url }}" 
                             alt="{{ $recipe->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $recipe->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('profile.show', $recipe->user) }}" 
                                   class="text-indigo-600 hover:underline">
                                    {{ $recipe->user->name }}
                                </a>
                                <div class="flex space-x-4">
                                    <span>❤️ {{ $recipe->likes->count() }}</span>
                                    <span>💬 {{ $recipe->comments->count() }}</span>
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
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="{{ $recipe->image_url }}" 
                     alt="{{ $recipe->title }}" 
                     class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $recipe->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('profile.show', $recipe->user) }}" 
                           class="text-indigo-600 hover:underline">
                            {{ $recipe->user->name }}
                        </a>
                        <div class="flex space-x-4">
                            <span>❤️ {{ $recipe->likes_count }}</span>
                            <span>💬 {{ $recipe->comments_count }}</span>
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
                            <!-- Similar card structure as above -->
                        @endforeach
                    </div>
                </section>
            @endif
        @endauth
    </div>
</x-app-layout>