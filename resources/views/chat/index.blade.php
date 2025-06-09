<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white/90 rounded-3xl shadow-xl p-10 border border-[#ffd6e0] animate-fadeInUp">
            <h2 class="text-3xl font-extrabold text-[#ac2358] mb-8 text-center">Mis Conversaciones</h2>
            <div class="space-y-4">
                @forelse($conversations as $userId => $messages)
                    @php
                        $otherUser = $messages->first()->sender_id === Auth::id() 
                            ? $messages->first()->receiver 
                            : $messages->first()->sender;
                    @endphp
                    <a href="{{ route('chat.show', $otherUser) }}" 
                       class="flex items-center p-6 rounded-2xl bg-[#fff0f4] hover:bg-[#ffd6e0] shadow transition">
                        <img src="{{ $otherUser->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($otherUser->name) }}" 
                             alt="{{ $otherUser->name }}" 
                             class="w-16 h-16 rounded-full border-4 border-[#ffd6e0] object-cover">
                        <div class="ml-6 flex-1">
                            <h3 class="font-bold text-xl text-[#ac2358]">{{ $otherUser->name }}</h3>
                            <p class="text-gray-600 text-base mt-1">
                                {{ Str::limit($messages->first()->content, 50) }}
                            </p>
                        </div>
                        <span class="ml-auto text-sm text-[#ac2358] font-semibold">
                            {{ $messages->first()->created_at->diffForHumans() }}
                        </span>
                    </a>
                @empty
                    <p class="text-gray-500 text-center">No tienes conversaciones aún</p>
                @endforelse
            </div>
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