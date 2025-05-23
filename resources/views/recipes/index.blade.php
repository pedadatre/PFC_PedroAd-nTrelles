<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Buscador -->
        <div class="mb-8">
            <form action="{{ route('recipes.search') }}" method="GET" class="flex gap-4">
                <input type="text" 
                       name="search" 
                       value="{{ $query ?? '' }}"
                       placeholder="Buscar recetas..." 
                       class="flex-1 border rounded-lg px-4 py-2">
                <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Buscar
                </button>
            </form>
        </div>

        <!-- Resultados -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($recipes as $recipe)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="{{ $recipe->image_url }}" 
                         alt="{{ $recipe->title }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">{{ $recipe->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4">
                                <span>❤️ {{ $recipe->likes()->count() }}</span>
                                <span>💬 {{ $recipe->comments()->count() }}</span>
                            </div>
                            <a href="{{ route('recipes.show', $recipe) }}" 
                               class="text-indigo-600 hover:underline">
                                Ver más
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">No se encontraron recetas</p>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $recipes->links() }}
        </div>
    </div>
</x-app-layout>