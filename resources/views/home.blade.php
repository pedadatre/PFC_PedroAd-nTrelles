<x-app-layout>
    <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(40px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp { animation: fadeInUp 1s ease-out forwards; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-rotate { animation: rotate 12s linear infinite; }
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <!-- SVGs flotantes en el fondo general -->
    <div class="fixed inset-0 -z-10 pointer-events-none">
        <svg class="absolute top-10 left-10 w-32 h-32 opacity-20 animate-float" fill="none" viewBox="0 0 64 64"><ellipse cx="32" cy="32" rx="32" ry="16" fill="#ffd6e0"/></svg>
        <svg class="absolute bottom-20 right-20 w-40 h-40 opacity-10 animate-rotate" fill="none" viewBox="0 0 64 64"><rect x="8" y="8" width="48" height="48" rx="24" fill="#ac2358"/></svg>
        <svg class="absolute top-1/2 left-1/4 w-24 h-24 opacity-10 animate-float" fill="none" viewBox="0 0 64 64"><path d="M32 8 Q40 32 56 32 Q40 32 32 56 Q24 32 8 32 Q24 32 32 8Z" fill="#fff0f4"/></svg>
        <svg class="absolute bottom-1/3 right-1/3 w-28 h-28 opacity-10 animate-float" fill="none" viewBox="0 0 64 64"><circle cx="32" cy="32" r="24" fill="#ac2358"/></svg>
    </div>

    <!-- HERO PRINCIPAL -->
    <section class="bg-gradient-to-r from-[#ac2358] to-[#7a1330] text-white py-20 mb-12 rounded-b-3xl shadow-xl relative overflow-hidden">
        <svg class="absolute top-8 left-8 w-24 h-24 opacity-30 animate-float" fill="none" viewBox="0 0 64 64"><circle cx="32" cy="32" r="32" fill="#fff0f4"/></svg>
        <svg class="absolute bottom-0 right-0 w-40 h-40 opacity-20 animate-rotate" fill="none" viewBox="0 0 64 64"><rect x="8" y="8" width="48" height="48" rx="24" fill="#fff0f4"/></svg>
        <svg class="absolute top-1/2 right-1/4 w-20 h-20 opacity-20 animate-float" fill="none" viewBox="0 0 64 64"><ellipse cx="32" cy="32" rx="24" ry="12" fill="#ffd6e0"/></svg>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="animate-fadeInUp text-5xl md:text-6xl font-extrabold mb-6 tracking-tight drop-shadow-lg">Bienvenido a <span class="text-[#ffd6e0]">GastroWorld</span></h1>
            <p class="animate-fadeInUp text-2xl md:text-2xl mb-10 text-[#ffd6e0] font-medium" style="animation-delay:0.2s;">Descubre, comparte y aprende nuevas recetas con nuestra comunidad de amantes de la cocina.</p>
            @guest
                <div class="flex flex-col sm:flex-row justify-center gap-6 mb-2 animate-fadeInUp" style="animation-delay:0.4s;">
                    <a href="{{ route('register') }}" class="bg-white text-[#ac2358] px-10 py-4 rounded-full font-bold shadow-lg hover:bg-[#ffd6e0] hover:text-[#7a1330] transition text-lg border-2 border-[#ac2358]">Registrarse</a>
                    <a href="{{ route('login') }}" class="bg-[#7a1330] text-white px-10 py-4 rounded-full font-bold shadow-lg hover:bg-[#ac2358] hover:text-white transition text-lg border-2 border-[#ac2358]">Iniciar Sesión</a>
                </div>
            @endguest
            @auth
                <a href="{{ route('recipes.create') }}" class="animate-fadeInUp bg-white text-[#ac2358] px-10 py-4 rounded-full font-bold shadow-lg hover:bg-[#ffd6e0] hover:text-[#7a1330] transition text-lg border-2 border-[#ac2358] inline-flex items-center" style="animation-delay:0.4s;">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Crear Nueva Receta
                </a>
            @endauth
        </div>
    </section>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container mx-auto px-4 py-12">
        <!-- Barra de búsqueda -->
        <div class="mb-14">
            <x-recipe-search :cuisineTypes="$cuisineTypes" />
        </div>
        <!-- Últimas Recetas o Resultados de Búsqueda -->
        <section class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-extrabold text-[#ac2358] tracking-tight">
                    @if($recipes && $recipes->count())
                        Resultados de la búsqueda
                    @else
                        Últimas Recetas
                    @endif
                </h2>
                <span class="block w-24 h-1 bg-[#ffd6e0] rounded-full"></span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @if($recipes && $recipes->count())
                    @foreach($recipes as $recipe)
                        <x-recipe-card :recipe="$recipe" />
                    @endforeach
                    <div class="col-span-3">
                        {{ $recipes->links() }}
                    </div>
                @else
                    @foreach($latestRecipes as $recipe)
                        <x-recipe-card :recipe="$recipe" />
                    @endforeach
                @endif
            </div>
            @if($recipes && $recipes->count() == 0 && request()->hasAny(['search','prep_time','cuisine_type','difficulty']))
                <div class="text-center text-gray-500 py-12 col-span-3">
                    No se encontraron recetas con esos filtros.
                </div>
            @endif
        </section>
    </div>
</x-app-layout>