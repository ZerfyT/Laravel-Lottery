<div class="mt-4">
    @if (isset($results))
        <div class="mb-2 flex justify-between">
            <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Results</h1>
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer transition ease-in-out duration-150 hover:scale-105 focus:scale-105" wire:click="startNewRound">Start
                New Round</button>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
            @foreach ($results as $result)
                <div
                    class="bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none">
                    <div class="p-6">
                        <h3 class="text-xl text-center font-semibold text-gray-900 dark:text-white">{{ $result->data }}
                        </h3>

                        <div class="flex flex-row justify-between align-middle mt-4">
                            <p class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">Round
                                {{ $result->round }}</p>

                            <p class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">{{ $result->date }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
