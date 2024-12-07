<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="block text-black font-medium text-black" />
            <x-text-input id="name" class="mt-2 block w-full px-4 py-3 border border-purple-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 text-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-black font-medium text-black" />
            <x-text-input id="email" class="mt-2 block w-full px-4 py-3 border border-purple-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 text-black" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="block text-black font-medium text-black" />
            <x-text-input id="password" class="mt-2 block w-full px-4 py-3 border border-purple-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 text-black" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-black font-medium text-black" />
            <x-text-input id="password_confirmation" class="mt-2 block w-full px-4 py-3 border border-purple-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 text-black" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="flex items-center justify-between">
            <a class="text-sm text-black hover:text-gray-100" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <!-- Submit Button -->
            <x-primary-button class="bg-purple-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
