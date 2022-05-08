<x-guest-layout>
    <x-slot name="image">
        <img
            aria-hidden="true"
            class="object-cover w-full h-full dark:hidden"
            src="{{asset("img/forgot-password-office.jpeg")}}"
            alt="Office"
        />
        <img
            aria-hidden="true"
            class="hidden object-cover w-full h-full dark:block"
            src="{{asset("img/forgot-password-office-dark.jpeg")}}"
            alt="Office"
        />
    </x-slot>

    <h1
        class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
    >
        Forgot password
    </h1>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />


    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <x-label for="email">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <x-input
                id="email"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="john@doe.com"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />
        </x-label>

    <button
        class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
    >
        Recover password
    </button>

    </form>

</x-guest-layout>
