<div class="mt-3">
    @if (isset($results))
        <div class="flex justify-between my-3">
            <h2 class="text-3xl">Results</h2>
            <button class="btn btn-wide btn-warning" wire:click="startNewRound">Start New Round</button>
        </div>
        <div class="flex gap-4 flex-wrap">
            @foreach ($results as $result)
                <div class="card bg-base-100 w-96 shadow-xl grow">
                    <div class="card-body">
                        <h2 class="card-title justify-center">
                            @foreach (explode(' ', $result->data) as $number)
                                <button class="btn btn-circle btn-outline btn-secondary">{{ $number }}</button>
                            @endforeach
                        </h2>
                        <div class="flex justify-between">
                        <p>Round {{ $result->round }}</p>
                            <p class="text-end">Date {{ $result->date }}</p>
                        </div>
                        <div class="card-actions justify-end">
                            <button class="btn btn-outline btn-primary" wire:click="viewMore({{ $result->id }})">View
                                more</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
