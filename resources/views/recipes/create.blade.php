<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold mb-8">Crear Nueva Receta</h1>

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Información Básica -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-800">Información Básica</h2>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Título de la Receta</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-200">
                        @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Descripción Breve</label>
                        <textarea name="description" rows="3" 
                                  class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-200">{{ old('description') }}</textarea>
                        @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Detalles de la Receta -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Tiempo de Preparación</label>
                        <input type="number" name="prep_time" value="{{ old('prep_time') }}" 
                               class="w-full border rounded-lg p-2" placeholder="Minutos">
                        @error('prep_time')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Dificultad</label>
                        <select name="difficulty" class="w-full border rounded-lg p-2">
                            <option value="">Seleccionar...</option>
                            <option value="facil" {{ old('difficulty') == 'facil' ? 'selected' : '' }}>Fácil</option>
                            <option value="medio" {{ old('difficulty') == 'medio' ? 'selected' : '' }}>Medio</option>
                            <option value="dificil" {{ old('difficulty') == 'dificil' ? 'selected' : '' }}>Difícil</option>
                        </select>
                        @error('difficulty')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Tipo de Cocina</label>
                        <select name="cuisine_type" class="w-full border rounded-lg p-2">
                            <option value="">Seleccionar...</option>
                            <option value="mediterranea">Mediterránea</option>
                            <option value="asiatica">Asiática</option>
                            <option value="mexicana">Mexicana</option>
                            <option value="italiana">Italiana</option>
                            <option value="francesa">Francesa</option>
                        </select>
                        @error('cuisine_type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <!-- Ingredientes -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-800">Ingredientes</h2>
                    <div id="ingredients-container" class="space-y-2">
                        <div class="flex gap-2">
                            <input type="text" name="ingredients[]" placeholder="Ingrediente" 
                                   class="flex-1 border rounded-lg p-2">
                            <button type="button" onclick="removeIngredient(this)" 
                                    class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                ✕
                            </button>
                        </div>
                    </div>
                    <button type="button" onclick="addIngredient()" 
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        + Añadir Ingrediente
                    </button>
                    @error('ingredients')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Instrucciones -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Instrucciones de Preparación</h2>
                    <textarea name="instructions" rows="6" 
                              class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-200">{{ old('instructions') }}</textarea>
                    @error('instructions')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <!-- Imagen -->
                <div>
                    <label class="block text-gray-700 mb-2">Imagen de la Receta</label>
                    <input type="file" name="image" accept="image/*" 
                           class="w-full border rounded-lg p-2">
                    @error('image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition">
                        Crear Receta
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addIngredient() {
            const container = document.getElementById('ingredients-container');
            const newIngredient = document.createElement('div');
            newIngredient.className = 'flex gap-2';
            newIngredient.innerHTML = `
                <input type="text" name="ingredients[]" placeholder="Ingrediente" 
                       class="flex-1 border rounded-lg p-2">
                <button type="button" onclick="removeIngredient(this)" 
                        class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    ✕
                </button>
            `;
            container.appendChild(newIngredient);
        }

        function removeIngredient(button) {
            const container = document.getElementById('ingredients-container');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
        }
    </script>
</x-app-layout>