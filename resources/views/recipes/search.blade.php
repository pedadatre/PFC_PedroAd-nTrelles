<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulario de búsqueda -->
            <form action="{{ route('recipes.search') }}" method="GET" class="mb-8">
                <div class="flex gap-4 mb-4">
                    <input type="text" 
                           name="search" 
                           placeholder="Buscar recetas..." 
                           value="{{ request('search') }}"
                           class="flex-1 border rounded-lg px-4 py-2">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                        Buscar
                    </button>
                </div>

                <!-- Filtros existentes -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                    <!-- ... tus filtros actuales ... -->
                </div>
            </form>

            <!-- Resultados -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($recipes as $recipe)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">
                                <a href="{{ route('recipes.show', $recipe) }}" class="hover:text-indigo-600">
                                    {{ $recipe->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Por {{ $recipe->user->name }}</span>
                                <span>{{ $recipe->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500">
                        No se encontraron recetas
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $recipes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>