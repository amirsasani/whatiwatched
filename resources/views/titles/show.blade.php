<x-app-layout>
    <div class="mt-4 px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex ">
            <img style="max-height: 25rem" class="mr-6" src="{{ $title->poster }}" alt="{{ $title->name }}">
            <div class="w-full">
                <ul class="dark:text-white">
                    <li class="flex items-center justify-between">
                        <h1 class="leading-5">{{ $title->name }}</h1>
                        <a href="{{ $title->imdb_url }}" target="_blank" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Open in IMDB
                        </a>
                    </li>
                    <hr class="mt-1 mb-4">
                    <li class="mb-4">
                        <p class="flex items-center font-semibold">
                            <svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            {{$title->rate_value}}
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            From {{number_format($title->rate_count)}} rates
                        </p>
                    </li>
                    <li class="mb-4">
                        <p class="flex items-center font-semibold mb-2">
                            <svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                            Genres:
                        </p>
                        <p>
                            @foreach($title->genres as $genre)
                                <span
                                    style="font-size: 0.9em;"
                                    class="px-2 py-1  mt-1 mb-1 mr-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                                >
                                    {{$genre}}
                                </span>
                            @endforeach
                        </p>
                    </li>
                    <li class="mb-4">
                        <p class="flex items-center font-semibold">
                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{$title->year_start}}
                            @if($title->year_end)
                                -
                                {{$title->year_end}}
                            @endif
                        </p>
                    </li>
                    @foreach($title->reviewServices as $reviewService)
                        <li class="mb-4">
                            <a href="{{ $reviewService->pivot->url }}" target="_blank" class="flex items-center font-semibold">
                                <img class="w-6 h-6 mr-1" src="{{ $reviewService->logo }}" alt="{{ $reviewService->name }}">
                                {{ number_format($reviewService->pivot->score) }}
                            </a>
                            @if($reviewService->pivot->count)
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    From {{number_format($reviewService->pivot->count)}} votes
                                </p>
                            @endif
                        </li>
                    @endforeach
                    <li>
                        <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                           href="{{ route('titles.poster', $title) }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>Create Poster for this Title</span>
                            </div>
                            <span>Create Now →</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>



</x-app-layout>
