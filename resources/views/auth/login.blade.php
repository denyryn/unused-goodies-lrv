<x-guest-layout>
    <x-authentication-card>

        <x-slot name="quote">
            <h1 class="text-5xl font-bold mb-4">Login now!</h1>
            <p>
                <livewire:login-quotes>
            </p>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form class="card-body" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-control">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block input input-bordered mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="form-control">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="input input-bordered block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                @if (Route::has('password.request'))
                    <x-link link="{{ route('password.request')  }}" class="my-1 self-end">
                        {{ __('Forgot your password?') }}
                    </x-link>
                @endif
            </div>

            <div class="form-control block">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="checkbox rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end">
                <x-link link="{{ route('register') }}">Haven't registered?</x-link>

                <x-button class="ms-4 form-control">
                    {{ __('Log in') }}
                </x-button>
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>