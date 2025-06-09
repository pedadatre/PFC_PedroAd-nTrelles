<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">
                        GastroWorld
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" 
                       class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('shop.index') }}"
                       class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Shop
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">
                            Monedas: <span class="font-bold text-indigo-600">{{ auth()->user()->coins_balance }}</span>
                        </span>
                        <button @click="$dispatch('open-create-modal')"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Nueva Receta
                        </button>
                        <a href="{{ route('profile.own') }}"
                           class="text-gray-500 hover:text-gray-700">
                            Mi Perfil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="text-gray-500 hover:text-gray-700">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                           class="text-gray-500 hover:text-gray-700">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            Registrarse
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>