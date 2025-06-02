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
                @auth
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('recipes.like', $recipe) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center space-x-1 {{ $recipe->isLikedByUser(Auth::user()) ? 'text-red-500' : 'text-gray-500' }}">
                                <span>❤️</span>
                                <span>{{ $recipe->likes_count }}</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>

            <img src="{{ url($recipe->image_url) }}" alt="{{ $recipe->title }}" class="w-full h-96 object-cover rounded-lg mb-6">            
            <!-- Ingredientes y Preparación -->
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