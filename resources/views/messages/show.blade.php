<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-6">
                <a href="{{ route('messages.index') }}" class="text-indigo-600 hover:text-indigo-800 mr-4">
                    ← Volver
                </a>
                <h1 class="text-2xl font-bold">Chat con {{ $user->name }}</h1>
            </div>

            <div class="space-y-4 mb-6 h-96 overflow-y-auto" id="messages-container">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="{{ $message->sender_id === Auth::id() ? 'bg-indigo-100' : 'bg-gray-100' }} rounded-lg p-4 max-w-md">
                            <p>{{ $message->content }}</p>
                            <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <form action="{{ route('messages.store', $user) }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" 
                       name="content" 
                       class="flex-1 border rounded-lg px-4 py-2" 
                       placeholder="Escribe tu mensaje..."
                       required>
                <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Enviar
                </button>
            </form>
        </div>
    </div>

    <script>
        const messagesContainer = document.getElementById('messages-container');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
</x-app-layout>