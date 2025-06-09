<div class="bg-white/90 rounded-3xl shadow-xl p-10 border border-[#ffd6e0] animate-fadeInUp">
    <form action="{{ route('home') }}" method="GET" class="space-y-6" id="recipe-search-form">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Búsqueda por texto -->
            <div class="col-span-full lg:col-span-2">
                <input type="text" 
                       name="search" 
                       placeholder="¿Qué te apetece cocinar hoy?" 
                       value="{{ request('search') }}"
                       class="w-full border-2 border-[#ffd6e0] rounded-full p-4 focus:ring-2 focus:ring-[#ac2358] focus:border-[#ac2358] text-lg placeholder-[#ac2358] transition-shadow focus:shadow-lg">
            </div>

            <!-- Tiempo de preparación -->
            <div>
                <input type="number" 
                       name="prep_time" 
                       placeholder="Tiempo máximo (minutos)" 
                       value="{{ request('prep_time') }}"
                       min="1"
                       class="w-full border-2 border-[#ffd6e0] rounded-full p-4 focus:ring-2 focus:ring-[#ac2358] focus:border-[#ac2358] text-lg placeholder-[#ac2358] transition-shadow focus:shadow-lg">
            </div>

            <!-- Tipo de cocina -->
            <div>
                <select name="cuisine_type" class="w-full border-2 border-[#ffd6e0] rounded-full p-4 focus:ring-2 focus:ring-[#ac2358] focus:border-[#ac2358] text-lg text-[#ac2358] transition-shadow focus:shadow-lg">
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
        <div class="flex flex-wrap gap-6 items-center">
            <label class="font-bold text-[#ac2358] text-lg">Dificultad:</label>
            <div class="flex gap-4" id="difficulty-radios">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="difficulty" value="facil" {{ request('difficulty') == 'facil' ? 'checked' : '' }} class="form-radio accent-[#ac2358] difficulty-radio">
                    <span class="ml-2 text-[#ac2358] font-semibold">Fácil</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="difficulty" value="medio" {{ request('difficulty') == 'medio' ? 'checked' : '' }} class="form-radio accent-[#ac2358] difficulty-radio">
                    <span class="ml-2 text-[#ac2358] font-semibold">Medio</span>
                </label>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="radio" name="difficulty" value="dificil" {{ request('difficulty') == 'dificil' ? 'checked' : '' }} class="form-radio accent-[#ac2358] difficulty-radio">
                    <span class="ml-2 text-[#ac2358] font-semibold">Difícil</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-[#ac2358] text-white px-10 py-4 rounded-full font-bold shadow-lg hover:bg-[#7a1330] transition text-lg border-2 border-[#ac2358] flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Buscar Recetas
            </button>
        </div>
    </form>
    <style>
        .animate-fadeInUp {
            animation: fadeInUp 0.8s cubic-bezier(0.39, 0.575, 0.565, 1) both;
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        // Permitir deseleccionar el radio de dificultad
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('.difficulty-radio');
            let lastChecked = null;
            radios.forEach(radio => {
                radio.addEventListener('mousedown', function(e) {
                    if (this.checked) {
                        lastChecked = this;
                    } else {
                        lastChecked = null;
                    }
                });
                radio.addEventListener('click', function(e) {
                    if (lastChecked === this) {
                        this.checked = false;
                        lastChecked = null;
                        // Opcional: limpiar el valor en el formulario
                        document.querySelectorAll('.difficulty-radio').forEach(r => r.blur());
                    } else {
                        lastChecked = this;
                    }
                });
            });
        });
    </script>
</div>