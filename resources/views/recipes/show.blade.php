<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Detalles de la Receta -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $recipe->title }}</h1>
                    <div class="flex items-center space-x-4 text-gray-600">
                        <a href="{{ route('profile.show', $recipe->user) }}" class="hover:text-indigo-600">
                            Por {{ $recipe->user->name }}
                        </a>
                        <span>{{ $recipe->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            <div class="flex space-x-6 mb-6 text-gray-600">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $recipe->prep_time }} minutos</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="capitalize">{{ $recipe->difficulty }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                    </svg>
                    <span class="capitalize">{{ $recipe->cuisine_type }}</span>
                </div>
            </div>
                @auth
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('recipes.like', $recipe) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center space-x-1 {{ $recipe->isLikedByUser(Auth::user()) ? 'text-red-500' : 'text-gray-500' }}">
                                <span>❤️</span>
                                <span>{{ $recipe->likes_count }}</span>
                            </button>
                        </form>
                        @if(Auth::id() === $recipe->user_id)
                            <button onclick="openDeleteModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                Eliminar
                            </button>

                            <!-- Delete Modal -->
                            <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
                                <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4 relative">
                                    <h3 class="text-2xl font-bold mb-4">¿Eliminar receta?</h3>
                                    <p class="text-gray-600 mb-6">¿Estás seguro de que quieres eliminar "{{ $recipe->title }}"? Esta acción no se puede deshacer.</p>
                                    <div class="flex justify-end space-x-4">
                                        <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                                            Cancelar
                                        </button>
                                        <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function openDeleteModal() {
                                    document.getElementById('deleteModal').classList.remove('hidden');
                                }

                                function closeDeleteModal() {
                                    document.getElementById('deleteModal').classList.add('hidden');
                                }
                            </script>
                        @endif
                    </div>
                @endauth
            </div>

            <img src="{{ url($recipe->image_url) }}" alt="{{ $recipe->title }}" class="w-full h-96 object-cover rounded-lg mb-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <h2 class="text-xl font-bold mb-4">Ingredientes</h2>
                    <ul class="list-disc list-inside space-y-2">
                        @foreach($recipe->ingredients as $ingredient)
                            <li>{{ $ingredient }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4">Preparación</h2>
                    <div class="prose max-w-none">
                        {!! $recipe->instructions !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Comentarios -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-6">Comentarios</h2>
            
            @auth
                <form action="{{ route('comments.store', $recipe) }}" method="POST" class="mb-8">
                    @csrf
                    <textarea name="content" 
                              rows="3" 
                              class="w-full border rounded-lg p-2 mb-2" 
                              placeholder="Escribe tu comentario..."></textarea>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        Comentar
                    </button>
                </form>
            @else
                <p class="text-gray-600 mb-8">
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Inicia sesión</a> 
                    para dejar un comentario
                </p>
            @endauth

            <div class="space-y-6">
                @forelse($recipe->comments as $comment)
                    <div class="flex space-x-4">
                        <img src="{{ $comment->user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($comment->user->name) }}" 
                             alt="{{ $comment->user->name }}" 
                             class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <a href="{{ route('profile.show', $comment->user) }}" 
                                       class="font-bold hover:text-indigo-600">
                                        {{ $comment->user->name }}
                                    </a>
                                    <span class="text-gray-500 text-sm">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p>{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center">No hay comentarios aún</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>