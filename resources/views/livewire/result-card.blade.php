<div class="mt-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
        @if (isset($results))
            @foreach ($results as $result)
                <div
                    class="bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none">
                    <div class="p-6">
                        <h3 class="text-xl text-center font-semibold text-gray-900 dark:text-white">{{ $result->data }}</h3>

                        <div class="flex flex-row justify-between align-middle mt-4">
                            <p class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">Round
                                {{ $result->round }}</p>

                            <p class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">{{ $result->date }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
