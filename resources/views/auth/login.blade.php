<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 via-amber-100 to-white py-10 px-4">
        <div class="w-full max-w-4xl grid lg:grid-cols-2 gap-10 items-center">
            <div class="hidden lg:flex flex-col items-center justify-center bg-white border border-amber-200/50 rounded-2xl shadow-xl p-12">
                <img src="{{ asset('images/logo.png') }}" alt="God's Own Cafeteria Logo" class="w-full max-w-xs h-auto drop-shadow-md">
                <div class="mt-8 text-center">
                    <p class="text-xs uppercase tracking-[0.25em] text-amber-700 font-bold">God's Own Cafeteria</p>
                    <h2 class="text-2xl font-semibold mt-2 text-ink">Welcome back, Chef</h2>
                    <p class="text-sm text-gray-500 mt-2 max-w-sm">Manage recipes, gallery, and contact details from your master dashboard.</p>
                </div>
            </div>

            <div class="bg-white border border-amber-200/50 shadow-lg rounded-2xl p-8">
                <div class="mb-8 text-center">
                    <p class="text-xs uppercase tracking-[0.25em] text-amber-700">Admin Access</p>
                    <h1 class="text-3xl font-semibold mt-2 text-ink">Sign in to dashboard</h1>
                    <p class="text-sm text-gray-500 mt-2">Enter your credentials to continue.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-amber-500 focus:ring-amber-500"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-700 shadow-sm focus:ring-amber-500" name="remember">
                            <span class="ms-2 text-gray-700">{{ __('Remember me') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="font-medium text-amber-700 hover:text-amber-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <x-primary-button class="w-full justify-center bg-amber-700 hover:bg-amber-800 border-0 py-3 text-base">
                        {{ __('Log in') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
