<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-sm border-b border-gastro-100 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-12 w-auto" />
                        <span class="text-xl font-semibold gradient-text">GastroWorld</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" 
                        class="text-gastro-600 hover:text-gastro-800 transition-colors duration-200">
                        {{ __('Home') }}
                    </x-nav-link>
                    @auth
                        <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.*')" 
                            class="text-gastro-600 hover:text-gastro-800 transition-colors duration-200">
                            {{ __('Tienda') }}
                        </x-nav-link>
                    @endauth
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                            class="text-gastro-600 hover:text-gastro-800 transition-colors duration-200">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div class="flex items-center bg-gastro-100/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm">
                        <span class="text-gastro-600 mr-2">🪙</span>
                        <span class="font-medium text-gastro-800">{{ Auth::user()->coins_balance }}</span>
                    </div>
                </div>
            @endauth

            <div class="relative mr-4">
                @auth
                    <a href="{{ route('notifications.index') }}" class="relative p-2 rounded-full hover:bg-gastro-100/50 transition-colors duration-200">
                        <svg class="w-6 h-6 text-gastro-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        @if(Auth::user()->notifications()->whereNull('read_at')->count() > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">
                                {{ Auth::user()->notifications()->whereNull('read_at')->count() }}
                            </span>
                        @endif
                    </a>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gastro-600 bg-white hover:bg-gastro-50 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.own')" class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gastro-600 hover:text-gastro-800 transition-colors duration-200">Login</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-gastro-600 hover:bg-gastro-700 focus:outline-none transition-colors duration-200">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gastro-600 hover:text-gastro-800 hover:bg-gastro-100 focus:outline-none focus:bg-gastro-100 focus:text-gastro-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                {{ __('Home') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gastro-100">
                <div class="px-4">
                    <div class="font-medium text-base text-gastro-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gastro-600">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-dropdown-link :href="route('profile.own')" class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')" class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="text-gastro-600 hover:text-gastro-800 hover:bg-gastro-50">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>