<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div> 
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full @error('name') border-red-500 @enderror" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <p class="mt-1 text-sm text-gray-500">Only letters and spaces allowed</p>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full @error('email') border-red-500 @enderror" type="email" name="email" :value="old('email')" required autocomplete="username" />
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full @error('password') border-red-500 @enderror"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <div class="mt-1 text-sm text-gray-500">
                Password must contain:
                <ul class="list-disc list-inside">
                    <li>At least 8 characters</li>
                    <li>One uppercase letter</li>
                    <li>One lowercase letter</li>
                    <li>One number</li>
                    <li>One special character (@$!%*?&)</li>
                </ul>
            </div>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full @error('password_confirmation') border-red-500 @enderror"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
