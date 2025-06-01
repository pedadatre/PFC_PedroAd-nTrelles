<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Monedas del usuario -->
        <div class="bg-yellow-100 rounded-lg p-4 mb-8 flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-yellow-600 text-2xl mr-2">🪙</span>
                <span class="font-bold text-xl">{{ $userCoins }} monedas</span>
            </div>
            <a href="{{ route('shop.inventory') }}" 
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Ver inventario
            </a>
        </div>

        <!-- Items de la tienda -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($items as $item)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="text-center mb-4">
                        <span class="text-4xl">{{ $item->icon }}</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">{{ $item->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center">
                            <span class="text-yellow-600 mr-1">🪙</span>
                            {{ $item->price }}
                        </span>
                        <form action="{{ route('shop.purchase', $item) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 
                                           {{ $userCoins < $item->price ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $userCoins < $item->price ? 'disabled' : '' }}>
                                Comprar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>