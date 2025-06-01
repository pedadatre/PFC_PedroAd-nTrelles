<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Crear Nueva Receta</h1>

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Título -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Título</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="w-full border rounded-lg px-4 py-2" 
                           value="{{ old('title') }}" 
                           required>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <textarea name="description" 
                              id="description" 
                              rows="3" 
                              class="w-full border rounded-lg px-4 py-2" 
                              required>{{ old('description') }}</textarea>
                </div>

                <!-- Ingredientes -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Ingredientes</label>
                    <div id="ingredients-container">
                        <div class="flex gap-2 mb-2">
                            <input type="text" 
                                   name="ingredients[]" 
                                   class="flex-1 border rounded-lg px-4 py-2" 
                                   required>
                            <button type="button" 
                                    onclick="addIngredient()" 
                                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                                +
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Instrucciones -->
                <div class="mb-4">
                    <label for="instructions" class="block text-gray-700 font-bold mb-2">Instrucciones</label>
                    <textarea name="instructions" 
                              id="instructions" 
                              rows="6" 
                              class="w-full border rounded-lg px-4 py-2" 
                              required>{{ old('instructions') }}</textarea>
                </div>

                <!-- Imagen -->
                <div class="mb-6">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Imagen</label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*" 
                           class="w-full border rounded-lg px-4 py-2" 
                           required>
                </div>

                <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Publicar Receta
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function addIngredient() {
            const container = document.getElementById('ingredients-container');
            const newInput = document.createElement('div');
            newInput.className = 'flex gap-2 mb-2';
            newInput.innerHTML = `
                <input type="text" 
                       name="ingredients[]" 
                       class="flex-1 border rounded-lg px-4 py-2" 
                       required>
                <button type="button" 
                        onclick="this.parentElement.remove()" 
                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    -
                </button>
            `;
            container.appendChild(newInput);
        }
    </script>
    @endpush
</x-app-layout>