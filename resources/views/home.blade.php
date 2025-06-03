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
                <!-- Hero Section se mantiene igual -->

        <!-- Barra de Búsqueda -->
        <x-recipe-search :cuisineTypes="$cuisineTypes" />

        <!-- Sección de Resultados de Búsqueda -->
        @if(request()->has('search') || request()->has('cuisine_type') || request()->has('prep_time'))
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-6">Resultados de búsqueda</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($recipes as $recipe)
                        <x-recipe-card :recipe="$recipe" />
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 text-lg">No encontramos recetas que coincidan con tu búsqueda</p>
                            <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-800 mt-4 inline-block">
                                Volver al inicio
                            </a>
                        </div>
                    @endforelse
                </div>
                {{ $recipes->links() }}
            </div>
        @else
            <!-- Últimas Recetas -->
            <section class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Últimas Recetas</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($latestRecipes as $recipe)
                        <x-recipe-card :recipe="$recipe" />
                    @endforeach
                </div>
            </section>

            <!-- Recetas Populares -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Recetas Populares</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($popularRecipes as $recipe)
                        <x-recipe-card :recipe="$recipe" />
                    @endforeach
                </div>
            </section>

            <!-- Recetas Recomendadas -->
            @auth
                @if($recommendedRecipes->isNotEmpty())
                    <section class="mb-12">
                        <h2 class="text-2xl font-bold mb-6">Recomendado para ti</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($recommendedRecipes as $recipe)
                                <x-recipe-card :recipe="$recipe" />
                            @endforeach
                        </div>
                    </section>
                @endif
            @endauth
        @endif   
    </div>
</x-app-layout>