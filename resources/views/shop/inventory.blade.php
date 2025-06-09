<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Encabezado -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gastro-800 mb-2">Mi Inventario</h1>
                <p class="text-gray-600">Gestiona tus items y personaliza tu perfil</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <!-- Items equipados -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gastro-800 mb-4">Items Equipados</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gastro-50 p-6 rounded-xl">
                            <h3 class="font-bold text-lg text-gastro-800 mb-4">Avatar Actual</h3>
                            @if(Auth::user()->activeAvatar)
                                <div class="text-center">
                                    <span class="text-6xl block mb-4">{{ Auth::user()->activeAvatar->icon }}</span>
                                    <p class="text-lg font-medium text-gray-700 mb-4">{{ Auth::user()->activeAvatar->name }}</p>
                                    <form action="{{ route('user.items.unequip', 'avatar') }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                            Desequipar
                                        </button>
                                    </form>
                                </div>
                            @else
                                <p class="text-gray-500 text-center">Sin avatar equipado</p>
                            @endif
                        </div>

                        <div class="bg-gastro-50 p-6 rounded-xl">
                            <h3 class="font-bold text-lg text-gastro-800 mb-4">Insignia Actual</h3>
                            @if(Auth::user()->activeBadge)
                                <div class="text-center">
                                    <span class="text-6xl block mb-4">{{ Auth::user()->activeBadge->icon }}</span>
                                    <p class="text-lg font-medium text-gray-700 mb-4">{{ Auth::user()->activeBadge->name }}</p>
                                    <form action="{{ route('user.items.unequip', 'badge') }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                            Desequipar
                                        </button>
                                    </form>
                                </div>
                            @else
                                <p class="text-gray-500 text-center">Sin insignia equipada</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Inventario -->
                <div>
                    <h2 class="text-2xl font-bold text-gastro-800 mb-6">Mi Inventario</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($items as $item)
                            <div class="bg-gastro-50 rounded-xl p-6 transition-transform hover:scale-105">
                                <div class="text-center mb-4">
                                    <span class="text-6xl block mb-4">{{ $item->icon }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gastro-800 mb-2 text-center">{{ $item->name }}</h3>
                                <p class="text-gray-600 mb-6 text-center">{{ $item->description }}</p>
                                <form action="{{ route('user.items.equip', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full bg-gastro-600 text-white px-6 py-3 rounded-lg hover:bg-gastro-700 transition">
                                        Equipar
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Botón de Volver -->
            <div class="mt-8 text-center">
                <a href="{{ route('shop.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gastro-600 text-white rounded-lg hover:bg-gastro-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a la Tienda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>