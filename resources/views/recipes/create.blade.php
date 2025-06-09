<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Encabezado -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gastro-800 mb-2">Crear Nueva Receta</h1>
                <p class="text-gray-600">Comparte tu receta con la comunidad de Gastroworld</p>
            </div>

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Información Básica -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-gastro-800 mb-6">Información Básica</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-gastro-700 font-medium mb-2">Título de la Receta</label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300"
                                   placeholder="Ej: Paella Valenciana">
                            @error('title')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gastro-700 font-medium mb-2">Descripción Breve</label>
                            <textarea name="description" 
                                      rows="3" 
                                      class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300"
                                      placeholder="Describe brevemente tu receta...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Detalles de la Receta -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-gastro-800 mb-6">Detalles de la Receta</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-gastro-700 font-medium mb-2">Tiempo de Preparación</label>
                            <div class="relative">
                                <input type="number" 
                                       name="prep_time" 
                                       value="{{ old('prep_time') }}" 
                                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300"
                                       placeholder="Minutos" 
                                       min="1">
                                <span class="absolute right-3 top-3 text-gray-500">min</span>
                            </div>
                            @error('prep_time')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gastro-700 font-medium mb-2">Dificultad</label>
                            <select name="difficulty" 
                                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300">
                                <option value="">Seleccionar...</option>
                                <option value="facil" {{ old('difficulty') == 'facil' ? 'selected' : '' }}>Fácil</option>
                                <option value="medio" {{ old('difficulty') == 'medio' ? 'selected' : '' }}>Medio</option>
                                <option value="dificil" {{ old('difficulty') == 'dificil' ? 'selected' : '' }}>Difícil</option>
                            </select>
                            @error('difficulty')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gastro-700 font-medium mb-2">Tipo de Cocina</label>
                            <select name="cuisine_type" 
                                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300">
                                <option value="">Seleccionar...</option>
                                <option value="mediterranea" {{ old('cuisine_type') == 'mediterranea' ? 'selected' : '' }}>Mediterránea</option>
                                <option value="asiatica" {{ old('cuisine_type') == 'asiatica' ? 'selected' : '' }}>Asiática</option>
                                <option value="mexicana" {{ old('cuisine_type') == 'mexicana' ? 'selected' : '' }}>Mexicana</option>
                                <option value="italiana" {{ old('cuisine_type') == 'italiana' ? 'selected' : '' }}>Italiana</option>
                                <option value="francesa" {{ old('cuisine_type') == 'francesa' ? 'selected' : '' }}>Francesa</option>
                            </select>
                            @error('cuisine_type')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Ingredientes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-gastro-800 mb-6">Ingredientes</h2>
                    
                    <div id="ingredients-container" class="space-y-3">
                        @if(old('ingredients'))
                            @foreach(old('ingredients') as $ingredient)
                                <div class="flex gap-3">
                                    <input type="text" 
                                           name="ingredients[]" 
                                           value="{{ $ingredient }}" 
                                           class="flex-1 border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300"
                                           placeholder="Ej: 200g de arroz">
                                    <button type="button" 
                                            onclick="removeIngredient(this)" 
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                        ✕
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-3">
                                <input type="text" 
                                       name="ingredients[]" 
                                       placeholder="Ej: 200g de arroz" 
                                       class="flex-1 border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300">
                                <button type="button" 
                                        onclick="removeIngredient(this)" 
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                    ✕
                                </button>
                            </div>
                        @endif
                    </div>

                    <button type="button" 
                            onclick="addIngredient()" 
                            class="mt-4 px-6 py-3 bg-gastro-600 text-white rounded-lg hover:bg-gastro-700 transition flex items-center justify-center space-x-2">
                        <span>+</span>
                        <span>Añadir Ingrediente</span>
                    </button>

                    @error('ingredients')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Instrucciones -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-gastro-800 mb-6">Instrucciones de Preparación</h2>
                    
                    <textarea name="instructions" 
                              rows="8" 
                              class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300"
                              placeholder="Describe paso a paso cómo preparar la receta...">{{ old('instructions') }}</textarea>
                    @error('instructions')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Imagen -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-gastro-800 mb-6">Imagen de la Receta</h2>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <input type="file" 
                               name="image" 
                               accept="image/*,.jpg,.jpeg,.png,.gif,.webp,.bmp,.tiff" 
                               class="hidden" 
                               id="image-upload"
                               onchange="previewImage(this)">
                        <label for="image-upload" 
                               class="cursor-pointer">
                            <div class="space-y-2">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                          stroke-width="2" 
                                          stroke-linecap="round" 
                                          stroke-linejoin="round" />
                                </svg>
                                <div class="text-gray-600">
                                    <span class="text-gastro-600 hover:text-gastro-700">Sube una imagen</span> o arrástrala aquí
                                </div>
                                <p class="text-sm text-gray-500">JPG, PNG, GIF, WEBP, BMP, TIFF hasta 5MB</p>
                            </div>
                        </label>
                        <div id="image-preview" class="mt-4 hidden">
                            <img src="" alt="Vista previa" class="max-h-48 mx-auto rounded-lg">
                        </div>
                    </div>
                    @error('image')
                        <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('home') }}" 
                       class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-gastro-600 text-white rounded-lg hover:bg-gastro-700 transition">
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
            newIngredient.className = 'flex gap-3';
            newIngredient.innerHTML = `
                <input type="text" 
                       name="ingredients[]" 
                       placeholder="Ej: 200g de arroz" 
                       class="flex-1 border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200 focus:border-gastro-300">
                <button type="button" 
                        onclick="removeIngredient(this)" 
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
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

        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const previewImg = preview.querySelector('img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>