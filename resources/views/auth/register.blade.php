<x-guest-layout>
    <x-slot name="image">
        <img
            aria-hidden="true"
            class="object-cover w-full h-full dark:hidden"
            src="{{asset("img/create-account-office.jpeg")}}"
            alt="Office"
        />
        <img
            aria-hidden="true"
            class="hidden object-cover w-full h-full dark:block"
            src="{{asset("img/create-account-office-dark.jpeg")}}"
            alt="Office"
        />
    </x-slot>

    <h1
        class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
    >
        Create account
    </h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <x-label for="name">
            <span class="text-gray-700 dark:text-gray-400">Full Name</span>
            <x-input
                id="name"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Jane Doe"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
            />
        </x-label>

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
            />
        </x-label>

        <x-label for="password">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <x-input
                id="password"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="***************"
                type="password"
                name="password"
                :value="old('password')"
                required
                autocomplete="new-password"
            />
        </x-label>

        <x-label for="password_confirmation">
            <span class="text-gray-700 dark:text-gray-400">Confirm Password</span>
            <x-input
                id="password_confirmation"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="***************"
                type="password"
                name="password_confirmation"
                required
            />
        </x-label>

        <button
            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        >
            Create account
        </button>
    </form>

    <hr class="my-8"/>

    <a
        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
        href="{{ route('auth.social.redirect', ['driver' => 'github']) }}"
    >
        <svg
            class="w-4 h-4 mr-2"
            aria-hidden="true"
            viewBox="0 0 24 24"
            fill="currentColor"
        >
            <path
                d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"
            />
        </svg>
        Github
    </a>
    <a
        class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
        href="{{ route('auth.social.redirect', ['driver' => 'google']) }}"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="currentColor" >
            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
        </svg>
        Google
    </a>

    <p class="mt-4">
        <a
            class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
            href="{{route("login")}}"
        >
            Already have an account? Login
        </a>
    </p>

</x-guest-layout>
