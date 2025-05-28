<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Items equipados -->
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4">Items Equipados</h2>
                <div class="flex gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-bold mb-2">Avatar Actual</h3>
                        @if(Auth::user()->activeAvatar)
                            <div class="text-center">
                                <span class="text-4xl">{{ Auth::user()->activeAvatar->icon }}</span>
                                <p class="mt-2">{{ Auth::user()->activeAvatar->name }}</p>
                                <form action="{{ route('user.items.unequip', 'avatar') }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800">Desequipar</button>
                                </form>
                            </div>
                        @else
                            <p class="text-gray-500">Sin avatar equipado</p>
                        @endif
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-bold mb-2">Insignia Actual</h3>
                        @if(Auth::user()->activeBadge)
                            <div class="text-center">
                                <span class="text-4xl">{{ Auth::user()->activeBadge->icon }}</span>
                                <p class="mt-2">{{ Auth::user()->activeBadge->name }}</p>
                                <form action="{{ route('user.items.unequip', 'badge') }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-800">Desequipar</button>
                                </form>
                            </div>
                        @else
                            <p class="text-gray-500">Sin insignia equipada</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Inventario -->
            <h2 class="text-xl font-bold mb-4">Mi Inventario</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($items as $item)
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="text-center mb-4">
                            <span class="text-4xl">{{ $item->icon }}</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">{{ $item->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                        <form action="{{ route('user.items.equip', $item) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                Equipar
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>