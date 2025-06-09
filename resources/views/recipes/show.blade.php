<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section con imagen de fondo -->
        <div class="relative h-96 mb-8 rounded-xl overflow-hidden">
            <img src="{{ url($recipe->image_url) }}" 
                 alt="{{ $recipe->title }}" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end">
                <div class="p-8 text-white">
                    <h1 class="text-4xl font-bold mb-2">{{ $recipe->title }}</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile.show', $recipe->user) }}" 
                           class="flex items-center hover:text-indigo-300 transition">
                            @if($recipe->user->activeAvatar)
                                <span class="text-2xl mr-2">{{ $recipe->user->activeAvatar->icon }}</span>
                            @endif
                            <span>Por {{ $recipe->user->name }}</span>
                        </a>
                        <span>•</span>
                        <span>{{ $recipe->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalles de la Receta -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Columna izquierda: Ingredientes -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                    <h2 class="text-2xl font-bold mb-6 text-gastro-800">Ingredientes</h2>
                    <ul class="space-y-3">
                        @foreach($recipe->ingredients as $ingredient)
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-gastro-600 rounded-full mr-3"></span>
                                <span>{{ $ingredient }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Información adicional -->
                    <div class="mt-8 pt-6 border-t">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gastro-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Tiempo</p>
                                    <p class="font-semibold">{{ $recipe->prep_time }} min</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gastro-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Dificultad</p>
                                    <p class="font-semibold capitalize">{{ $recipe->difficulty }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gastro-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Cocina</p>
                                    <p class="font-semibold capitalize">{{ $recipe->cuisine_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @auth
                        <div class="mt-6 pt-6 border-t">
                            <form action="{{ route('recipes.like', $recipe) }}" method="POST" class="mb-4">
                                @csrf
                                <button type="submit" 
                                        class="w-full flex items-center justify-center space-x-2 bg-gastro-600 text-white px-4 py-2 rounded-lg hover:bg-gastro-700 transition">
                                    <span>❤️</span>
                                    <span>Me gusta ({{ $recipe->likes->count() }})</span>
                                </button>
                            </form>

                            @if(Auth::id() === $recipe->user_id)
                                <div class="flex space-x-2">
                                    <a href="{{ route('recipes.edit', $recipe) }}" 
                                       class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-center">
                                        Editar
                                    </a>
                                    <button onclick="openDeleteModal()" 
                                            class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                                        Eliminar
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Columna derecha: Instrucciones y Comentarios -->
            <div class="md:col-span-2 space-y-8">
                <!-- Instrucciones -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-6 text-gastro-800">Preparación</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($recipe->instructions)) !!}
                    </div>
                </div>

                <!-- Comentarios -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold mb-6 text-gastro-800">Comentarios</h2>
                    
                    @auth
                        <form action="{{ route('comments.store', $recipe) }}" method="POST" class="mb-8">
                            @csrf
                            <textarea name="content" 
                                      rows="3" 
                                      class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-gastro-200" 
                                      placeholder="Escribe tu comentario..."></textarea>
                            <div class="flex justify-end mt-2">
                                <button type="submit" 
                                        class="bg-gastro-600 text-white px-6 py-2 rounded-lg hover:bg-gastro-700 transition">
                                    Comentar
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="bg-gray-50 rounded-lg p-4 mb-8">
                            <p class="text-gray-600">
                                <a href="{{ route('login') }}" class="text-gastro-600 hover:underline">Inicia sesión</a> 
                                para dejar un comentario
                            </p>
                        </div>
                    @endauth

                    <div class="space-y-6">
                        @forelse($recipe->comments as $comment)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    @if($comment->user->activeAvatar)
                                        <span class="text-3xl">{{ $comment->user->activeAvatar->icon }}</span>
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" 
                                             alt="{{ $comment->user->name }}" 
                                             class="w-10 h-10 rounded-full">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <a href="{{ route('profile.show', $comment->user) }}" 
                                               class="font-bold hover:text-gastro-600">
                                                {{ $comment->user->name }}
                                            </a>
                                            <span class="text-gray-500 text-sm">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-gray-700">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No hay comentarios aún</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Eliminación -->
    @if(Auth::check() && Auth::id() === $recipe->user_id)
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-8 rounded-xl shadow-xl max-w-md w-full mx-4">
                <h3 class="text-2xl font-bold mb-4">¿Eliminar receta?</h3>
                <p class="text-gray-600 mb-6">¿Estás seguro de que quieres eliminar "{{ $recipe->title }}"? Esta acción no se puede deshacer.</p>
                <div class="flex justify-end space-x-4">
                    <button onclick="closeDeleteModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                        Cancelar
                    </button>
                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
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
</x-app-layout>