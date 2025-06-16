<x-guest-layout>
<div class="flex flex-col items-center justify-center min-h-screen bg-[#6e9cbc]"> <!-- Warna background -->
    <div class="w-full max-w-md p-6 bg-[#c2d1df] rounded-md shadow-md"> <!-- Warna card login -->
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Register</h2> <!-- Judul -->

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
            required autocomplete="username" pattern="^[a-zA-Z0-9._%+-]+@student\.stikomyos\.ac\.id$"
            title="Email harus menggunakan domain @student.stikomyos.ac.id" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <p class="text-xs text-gray-500 mt-1">Email harus menggunakan domain <strong>@student.stikomyos.ac.id</strong></p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <!-- <x-social-links /> -->
</x-guest-layout>
