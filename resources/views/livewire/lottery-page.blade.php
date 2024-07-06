<div class="mt-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
        @if (isset($lotteries))
            @foreach ($lotteries as $lottery)
                <button type="button" wire:click="selectLottery({{ $lottery->id }})"
                    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-indigo-500">
                    <div>
                        <div
                            class="flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 dark:bg-indigo-900/20">
                            <svg class="text-indigo-400 fill-current w-7 h-7" viewBox="0 0 50 31" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#a)">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M25 0c-6.667 0-10.833 3.382-12.5 10.146 2.5-3.382 5.417-4.65 8.75-3.805 1.902.482 3.261 1.882 4.766 3.432 2.45 2.524 5.288 5.445 11.484 5.445 6.667 0 10.833-3.382 12.5-10.145-2.5 3.382-5.417 4.65-8.75 3.804-1.902-.482-3.261-1.882-4.766-3.431C34.034 2.922 31.196 0 25 0ZM12.5 15.218C5.833 15.218 1.667 18.6 0 25.364c2.5-3.382 5.417-4.65 8.75-3.805 1.902.483 3.261 1.883 4.766 3.432 2.45 2.524 5.288 5.445 11.484 5.445 6.667 0 10.833-3.381 12.5-10.145-2.5 3.382-5.417 4.65-8.75 3.805-1.902-.483-3.261-1.883-4.766-3.432-2.45-2.524-5.288-5.446-11.484-5.446Z"
                                        fill="currentColor" />
                                </g>
                                <defs>
                                    <clipPath id="a">
                                        <rect width="50" height="31" fill="currentColor" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ $lottery->name }}</h2>

                        <p class="mt-4 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                            {{ $lottery->description }}
                        </p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="self-center w-6 h-6 mx-6 shrink-0 stroke-indigo-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </button>
            @endforeach
        @endif
    </div>

    @livewire('result-card')
</div>
