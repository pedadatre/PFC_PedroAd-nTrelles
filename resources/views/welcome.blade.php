<x-app-layout>
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <!-- Añadir verificación para las rutas -->
<a href="{{ route('recipes.search') }}" class="text-sm font-semibold leading-6 text-gray-900">
    Explorar recetas <span aria-hidden="true">→</span>
</a>
        <div class="mx-auto max-w-7xl py-32 sm:py-48 lg:py-56">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    GastroWorld
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Descubre, comparte y aprende nuevas recetas con nuestra comunidad de amantes de la cocina
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    @auth
                        <a href="{{ route('recipes.create') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Crear Receta
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Únete a nosotros
                        </a>
                    @endauth
                    <a href="{{ route('recipes.search') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        Explorar recetas <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Recetas Destacadas -->
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Recetas Destacadas</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    Las recetas más populares de nuestra comunidad
                </p>
            </div>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($featuredRecipes as $recipe)
                    <article class="flex flex-col items-start">
                        <div class="relative w-full">
                            <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                        </div>
                        <div class="max-w-xl">
                            <div class="mt-8 flex items-center gap-x-4 text-xs">
                                <time datetime="{{ $recipe->created_at }}" class="text-gray-500">
                                    {{ $recipe->created_at->format('M d, Y') }}
                                </time>
                                <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                                    {{ $recipe->category }}
                                </span>
                            </div>
                            <div class="group relative">
                                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    <a href="{{ route('recipes.show', $recipe) }}">
                                        {{ $recipe->title }}
                                    </a>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                    {{ $recipe->description }}
                                </p>
                            </div>
                            <div class="relative mt-8 flex items-center gap-x-4">
                                <img src="{{ $recipe->user->avatar_url }}" alt="" class="h-10 w-10 rounded-full bg-gray-100">
                                <div class="text-sm leading-6">
                                    <p class="font-semibold text-gray-900">
                                        <a href="{{ route('profile.show', $recipe->user) }}">
                                            {{ $recipe->user->name }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>