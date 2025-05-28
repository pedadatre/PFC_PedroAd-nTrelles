<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Mensajes</h1>
            
            <div class="space-y-4">
                @forelse($conversations as $conversation)
                    <div class="flex items-center justify-between p-4 hover:bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            @if($conversation->activeAvatar)
                                <span class="text-4xl mr-3">{{ $conversation->activeAvatar->icon }}</span>
                            @else
                                <img src="{{ $conversation->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($conversation->name) }}" 
                                     alt="{{ $conversation->name }}" 
                                     class="w-12 h-12 rounded-full mr-3">
                            @endif
                            <div>
                                <h3 class="font-medium">{{ $conversation->name }}</h3>
                                <p class="text-sm text-gray-600">Último mensaje: {{ $conversation->latest_message->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a href="{{ route('messages.show', $conversation) }}" 
                           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                            Ver conversación
                        </a>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No tienes conversaciones activas</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>