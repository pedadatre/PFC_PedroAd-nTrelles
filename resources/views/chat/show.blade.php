<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white/90 rounded-3xl shadow-xl p-10 border border-[#ffd6e0] animate-fadeInUp">
            <!-- Encabezado del chat -->
            <div class="flex items-center mb-8">
                <a href="{{ route('chat.index') }}" class="mr-6 flex items-center px-4 py-2 bg-[#ffd6e0] text-[#ac2358] rounded-full font-bold shadow hover:bg-[#fff0f4] transition border-2 border-[#ac2358]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    Volver a chats
                </a>
                <a href="{{ route('profile.show', $user) }}" class="flex items-center group">
                    <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                         alt="{{ $user->name }}" 
                         class="w-12 h-12 rounded-full border-2 border-[#ffd6e0] group-hover:border-[#ac2358] transition">
                    <h2 class="text-2xl font-extrabold ml-4 text-[#ac2358] group-hover:underline">{{ $user->name }}</h2>
                </a>
            </div>

            <!-- Mensajes -->
            <div class="space-y-4 mb-8 h-96 overflow-y-auto" id="messages-container">
                @foreach($messages as $message)
                    <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="{{ $message->sender_id === Auth::id() ? 'bg-[#ac2358] text-white' : 'bg-[#fff0f4] text-[#7a1330]' }} rounded-xl px-5 py-3 max-w-[70%] shadow">
                            <p>{{ $message->content }}</p>
                            <span class="text-xs {{ $message->sender_id === Auth::id() ? 'text-[#ffd6e0]' : 'text-[#ac2358]' }}">
                                {{ $message->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Formulario para enviar mensajes -->
            <form action="{{ route('chat.store', $user) }}" method="POST" class="flex gap-4 mt-4">
                @csrf
                <input type="text" 
                       name="content" 
                       class="flex-1 border rounded-lg px-4 py-2" 
                       placeholder="Escribe un mensaje...">
                <button type="submit" 
                        class="bg-[#ac2358] text-white px-8 py-2 rounded-full font-bold shadow hover:bg-[#7a1330] transition border-2 border-[#ac2358]">
                    Enviar
                </button>
            </form>
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
    @push('scripts')
    <script>
        // Auto-scroll al último mensaje
        const messagesContainer = document.getElementById('messages-container');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
    @endpush
</x-app-layout>