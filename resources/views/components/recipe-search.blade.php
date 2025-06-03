<div class="bg-white rounded-lg shadow-lg p-6 mb-8">
    <form action="{{ route('home') }}" method="GET" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Búsqueda por texto -->
            <div class="col-span-full lg:col-span-2">
                <input type="text" 
                       name="search" 
                       placeholder="¿Qué te apetece cocinar hoy?" 
                       value="{{ request('search') }}"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-200">
            </div>

            <!-- Tiempo de preparación -->
            <div>
                <input type="number" 
                       name="prep_time" 
                       placeholder="Tiempo máximo (minutos)" 
                       value="{{ request('prep_time') }}"
                       min="1"
                       class="w-full border rounded-lg p-3">
            </div>

            <!-- Tipo de cocina -->
            <div>
                <select name="cuisine_type" class="w-full border rounded-lg p-3">
                    <option value="">Tipo de cocina</option>
                    <option value="mediterranea" {{ request('cuisine_type') == 'mediterranea' ? 'selected' : '' }}>Mediterránea</option>
                    <option value="asiatica" {{ request('cuisine_type') == 'asiatica' ? 'selected' : '' }}>Asiática</option>
                    <option value="mexicana" {{ request('cuisine_type') == 'mexicana' ? 'selected' : '' }}>Mexicana</option>
                    <option value="italiana" {{ request('cuisine_type') == 'italiana' ? 'selected' : '' }}>Italiana</option>
                    <option value="francesa" {{ request('cuisine_type') == 'francesa' ? 'selected' : '' }}>Francesa</option>
                </select>
            </div>
        </div>

        <!-- Dificultad -->
        <div class="flex gap-4 items-center">
            <label class="font-medium">Dificultad:</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="difficulty" value="facil" {{ request('difficulty') == 'facil' ? 'checked' : '' }} class="form-radio">
                    <span class="ml-2">Fácil</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="difficulty" value="medio" {{ request('difficulty') == 'medio' ? 'checked' : '' }} class="form-radio">
                    <span class="ml-2">Medio</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="difficulty" value="dificil" {{ request('difficulty') == 'dificil' ? 'checked' : '' }} class="form-radio">
                    <span class="ml-2">Difícil</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition">
                Buscar Recetas
            </button>
        </div>
    </form>
</div>