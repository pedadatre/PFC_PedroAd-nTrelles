<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Notificaciones</h1>
                @if($notifications->where('read_at', null)->count() > 0)
                    <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="text-indigo-600 hover:text-indigo-800">
                            Marcar todas como leídas
                        </button>
                    </form>
                @endif
            </div>

            <div class="space-y-4">
                @forelse($notifications as $notification)
                    <div class="flex items-start p-4 {{ $notification->read_at ? 'bg-gray-50' : 'bg-indigo-50' }} rounded-lg">
                        <div class="flex-1">
                            @if($notification->type === 'new_message')
                                <p>
                                    <a href="{{ route('profile.show', $notification->data['sender_id']) }}" 
                                       class="font-bold hover:text-indigo-600">
                                        {{ $notification->data['sender_name'] }}
                                    </a>
                                    te ha enviado un mensaje
                                    <a href="{{ route('messages.show', $notification->data['sender_id']) }}" 
                                       class="text-indigo-600 hover:text-indigo-800 ml-2">
                                        Ver conversación
                                    </a>
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ Str::limit($notification->data['message'], 100) }}
                                </p>
                            @endif
                            <span class="text-xs text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="text-sm text-gray-600 hover:text-gray-800">
                                    Marcar como leída
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-gray-500">No tienes notificaciones</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>