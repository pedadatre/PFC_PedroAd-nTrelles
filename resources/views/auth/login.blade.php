<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-white to-gastro-50">
        <div class="w-full sm:max-w-lg md:max-w-xl lg:max-w-2xl px-8 md:px-10 py-10 bg-white/80 backdrop-blur-sm shadow-lg overflow-hidden sm:rounded-2xl animate-fade-in-up">
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-2">
                    <x-application-logo class="h-14 w-14 animate-bounce-slow" />
                </div>
                <h2 class="text-3xl font-bold gradient-text mb-2">Bienvenido de nuevo</h2>
                <p class="text-gray-600">Inicia sesión para continuar</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gastro-800" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gastro-200 focus:border-gastro-500 focus:ring focus:ring-gastro-200 focus:ring-opacity-50 transition-all duration-300" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gastro-800" />

                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gastro-200 focus:border-gastro-500 focus:ring focus:ring-gastro-200 focus:ring-opacity-50 transition-all duration-300"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gastro-300 text-gastro-600 shadow-sm focus:ring-gastro-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gastro-600 hover:text-gastro-800 transition-colors duration-200" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3 bg-gastro-600 hover:bg-gastro-700 focus:bg-gastro-700 active:bg-gastro-800 rounded-lg shadow-md transition-all duration-300">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        ¿No tienes una cuenta? 
                        <a href="{{ route('register') }}" class="text-gastro-600 hover:text-gastro-800 font-medium transition-colors duration-200">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <style>
        .animate-fade-in-up {
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
        .animate-bounce-slow {
            animation: bounce 2.5s infinite;
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</x-guest-layout>
