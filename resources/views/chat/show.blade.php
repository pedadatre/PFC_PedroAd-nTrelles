<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Encabezado del chat -->
            <div class="flex items-center mb-6">
                <a href="{{ route('chat.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                     alt="{{ $user->name }}" 
                     class="w-12 h-12 rounded-full">
                <h2 class="text-xl font-bold ml-4">{{ $user->name }}</h2>
            </div>

            <!-- Mensajes -->
            <div class="space-y-4 mb-6 h-96 overflow-y-auto" id="messages-container">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="{{ $message->sender_id === Auth::id() ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-900' }} rounded-lg px-4 py-2 max-w-[70%]">
                            <p>{{ $message->content }}</p>
                            <span class="text-xs {{ $message->sender_id === Auth::id() ? 'text-indigo-200' : 'text-gray-500' }}">
                                {{ $message->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Formulario para enviar mensajes -->
            <form action="{{ route('chat.store', $user) }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" 
                       name="content" 
                       class="flex-1 border rounded-lg px-4 py-2" 
                       placeholder="Escribe un mensaje...">
                <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                    Enviar
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-scroll al último mensaje
        const messagesContainer = document.getElementById('messages-container');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
    @endpush
</x-app-layout>