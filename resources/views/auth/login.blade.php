<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-primary font-medium text-black" />
            <x-text-input id="email" class="mt-2 block w-full px-4 py-3 border border-purple-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 text-black" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-primary font-medium text-black" />
            <div class="relative">
                <x-text-input id="password" class="mt-2 block w-full px-4 py-3 border border-purple-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 text-black" type="password" name="password" required autocomplete="current-password" />
                <!-- Show Password Toggle -->
                <input type="checkbox" id="showPassword" class="absolute top-4  right-3 text-purple-300 cursor-pointer" onclick="togglePassword()">
                <label for="showPassword" class="text-sm text-black cursor-pointer absolute top-4 right-12">
                    {{ __('Show') }}
                </label>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center text-black">
                <input id="remember_me" type="checkbox" class="rounded text-black border-purple-600 focus:ring-purple-500" name="remember">
                <span class="ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-sm text-black hover:text-black-100" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <!-- Submit Button -->
            <x-primary-button class="bg-purple-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('showPassword');
            if (showPasswordCheckbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
</x-guest-layout>
