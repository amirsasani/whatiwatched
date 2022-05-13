<x-app-layout>
    <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
        New Title
    </h2>
    <!-- CTA -->


    <form class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" method="post" action="{{ route('titles.store') }}">
        @csrf

        <label class="block mt-3 text-sm">
            <span class="text-gray-700 dark:text-gray-400">IMDB Url</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                name="imdb_url"
                placeholder="https://www.imdb.com/title/tt0108778/">
        </label>

        @foreach($reviewServices as $reviewService)
            <label class="block mt-4 text-sm">
                <span class="flex flex items-center justify-start text-gray-700 dark:text-gray-400">
                    <img src="{{ $reviewService->logo }}"
                         alt="{{ \Illuminate\Support\Str::headline($reviewService->name) }}"
                         class="rounded w-6 mr-2 ml-2">
                    {{ \Illuminate\Support\Str::headline($reviewService->name) }}
                </span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="{{ \Illuminate\Support\Str::headline($reviewService->name) }} Url"
                name="service[{{$reviewService->id}}]">
            </label>
        @endforeach

        <div class="flex justify-end">
            <button
                class="mt-6 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Create
            </button>
        </div>
    </form>


</x-app-layout>
