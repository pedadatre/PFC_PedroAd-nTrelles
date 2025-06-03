<div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
    <img src="{{ $recipe->image_url }}" 
         alt="{{ $recipe->title }}" 
         class="w-full h-48 object-cover">
    <div class="p-6">
        <h3 class="font-bold text-xl mb-2">
            <a href="{{ route('recipes.show', $recipe) }}" 
               class="hover:text-indigo-600 transition">
                {{ $recipe->title }}
            </a>
        </h3>
        <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
        <div class="flex justify-between items-center">
            <a href="{{ route('profile.show', $recipe->user) }}" 
               class="flex items-center text-indigo-600 hover:text-indigo-700">
                @if($recipe->user->activeAvatar)
                    <span class="text-2xl mr-2">{{ $recipe->user->activeAvatar->icon }}</span>
                @endif
                {{ $recipe->user->name }}
            </a>
            <div class="flex items-center space-x-4 text-gray-500">
                <span class="flex items-center">
                    <span class="text-red-500 mr-1">❤️</span>
                    {{ $recipe->likes_count }}
                </span>
                <span class="flex items-center">
                    <span class="text-gray-600 mr-1">💬</span>
                    {{ $recipe->comments_count }}
                </span>
            </div>
        </div>
    </div>
</div>