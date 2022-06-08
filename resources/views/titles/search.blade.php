<x-app-layout>
    <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
        Search results for "{{ $q }}"
    </h2>

    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Rate</th>
                    <th class="px-4 py-3">Genres</th>
                    <th class="px-4 py-3">Year</th>
                </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                @foreach($titles as $title)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div
                                    class="relative hidden w-12 h-12 mr-3 rounded-full md:block"
                                >
                                    <img
                                        class="object-cover w-full h-full rounded-full"
                                        src="{{ $title->poster }}"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div
                                        class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <a class="font-semibold" href="{{ route('titles.show', $title) }}">
                                        {{$title->name}}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div>
                                <p class="flex items-center  font-semibold">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    {{$title->rate_value}}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    From {{number_format($title->rate_count)}} rates
                                </p>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-xs">
                            @foreach($title->genres as $genre)
                                <span
                                    class="px-2 py-1  mt-1 mb-1 mr-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                                >
                                    {{$genre}}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{$title->year_start}}
                                @if($title->year_end)
                                    -
                                    {{$title->year_end}}
                                @endif
                            </p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$titles->links('titles.pagination')}}
    </div>
</x-app-layout>
