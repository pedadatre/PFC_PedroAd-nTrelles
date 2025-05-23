<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6">Mis Conversaciones</h2>
            
            <div class="space-y-4">
                @forelse($conversations as $userId => $messages)
                    @php
                        $otherUser = $messages->first()->sender_id === Auth::id() 
                            ? $messages->first()->receiver 
                            : $messages->first()->sender;
                    @endphp
                    
                    <a href="{{ route('chat.show', $otherUser) }}" 
                       class="flex items-center p-4 rounded-lg hover:bg-gray-50">
                        <img src="{{ $otherUser->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($otherUser->name) }}" 
                             alt="{{ $otherUser->name }}" 
                             class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h3 class="font-semibold">{{ $otherUser->name }}</h3>
                            <p class="text-gray-600 text-sm">
                                {{ Str::limit($messages->first()->content, 50) }}
                            </p>
                        </div>
                        <span class="ml-auto text-sm text-gray-500">
                            {{ $messages->first()->created_at->diffForHumans() }}
                        </span>
                    </a>
                @empty
                    <p class="text-gray-500 text-center">No tienes conversaciones aún</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>