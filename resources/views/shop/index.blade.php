<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <!-- Monedas del usuario -->
        <div class="bg-gradient-to-r from-[#ffd6e0] to-[#fff0f4] rounded-2xl p-6 mb-10 flex items-center justify-between shadow-md">
            <div class="flex items-center">
                <span class="text-[#ac2358] text-3xl mr-3">🪙</span>
                <span class="font-extrabold text-2xl text-[#ac2358]">{{ $userCoins }} monedas</span>
            </div>
            <a href="{{ route('shop.inventory') }}" 
               class="bg-[#ac2358] text-white px-6 py-3 rounded-full font-bold shadow-lg hover:bg-[#7a1330] transition text-lg border-2 border-[#ac2358]">
                Ver inventario
            </a>
        </div>

        <!-- Items de la tienda -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($items as $item)
                <div class="bg-white/90 rounded-3xl shadow-xl p-8 border border-[#ffd6e0] flex flex-col items-center animate-fadeInUp hover:scale-[1.03] hover:shadow-2xl transition-all duration-300">
                    <div class="text-center mb-4">
                        <span class="text-5xl">{{ $item->icon }}</span>
                    </div>
                    <h3 class="text-2xl font-extrabold mb-2 text-[#ac2358]">{{ $item->name }}</h3>
                    <p class="text-gray-600 mb-6 text-center">{{ $item->description }}</p>
                    <div class="flex justify-between items-center w-full mt-auto">
                        <span class="flex items-center text-lg font-bold text-[#ac2358] bg-[#ffd6e0] px-4 py-2 rounded-full">
                            <span class="mr-2">🪙</span>
                            {{ $item->price }}
                        </span>
                        <form action="{{ route('shop.purchase', $item) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="ml-4 bg-[#ac2358] text-white px-6 py-2 rounded-full font-bold shadow-lg hover:bg-[#7a1330] transition border-2 border-[#ac2358] text-lg
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
</x-app-layout>