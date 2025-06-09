<div class="bg-white/90 rounded-3xl shadow-xl overflow-hidden transform hover:scale-[1.03] hover:shadow-2xl transition-all duration-300 border border-[#ffd6e0] animate-fadeInUp">
    <div class="relative group">
        <img src="{{ $recipe->image_url }}"
             alt="{{ $recipe->title }}"
             class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-105 rounded-t-3xl">
        <a href="{{ route('recipes.show', $recipe) }}"
           class="absolute top-3 right-3 bg-[#ac2358] text-white px-4 py-1 rounded-full text-xs font-semibold shadow-lg hover:bg-[#7a1330] transition">
            Ver receta
        </a>
    </div>
    <div class="p-6">
        <div class="flex flex-wrap gap-2 mb-3">
            @if($recipe->prep_time)
                <span class="inline-flex items-center px-3 py-1 bg-[#ffd6e0] text-[#ac2358] rounded-full text-xs font-semibold">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $recipe->prep_time }} min
                </span>
            @endif
            @if($recipe->difficulty)
                <span class="inline-flex items-center px-3 py-1 bg-[#ac2358] text-white rounded-full text-xs font-semibold capitalize">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    {{ $recipe->difficulty }}
                </span>
            @endif
            @if($recipe->cuisine_type)
                <span class="inline-flex items-center px-3 py-1 bg-[#fff0f4] text-[#7a1330] rounded-full text-xs font-semibold capitalize">
                    🍽️ {{ $recipe->cuisine_type }}
                </span>
            @endif
        </div>
        <h3 class="font-extrabold text-2xl mb-2 text-[#ac2358] leading-tight">
            <a href="{{ route('recipes.show', $recipe) }}" class="hover:text-[#7a1330] transition">
                {{ $recipe->title }}
            </a>
        </h3>
        <p class="text-gray-600 mb-4 min-h-[48px]">{{ Str::limit($recipe->description, 100) }}</p>
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('profile.show', $recipe->user) }}"
               class="flex items-center text-[#ac2358] hover:text-[#7a1330] font-semibold">
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