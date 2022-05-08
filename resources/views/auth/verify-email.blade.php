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
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif


    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button
            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
            {{ __('Resend Verification Email') }}
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline">
            {{ __('Log Out') }}
        </button>
    </form>

</x-guest-layout>
