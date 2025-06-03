<div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
    <img src="{{ $recipe->image_url }}" 
         alt="{{ $recipe->title }}" 
         class="w-full h-48 object-cover">
    <div class="p-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
            @if($recipe->prep_time)
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $recipe->prep_time }} min
                </span>
            @endif
            @if($recipe->difficulty)
                <span class="flex items-center capitalize">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    {{ $recipe->difficulty }}
                </span>
            @endif
        </div>
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