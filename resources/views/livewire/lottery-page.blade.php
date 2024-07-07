<div class="flex justify-center gap-4">
    @if (isset($lotteries))
        @foreach ($lotteries as $lottery)
            <div class="card card-compact bg-base-100 w-96 shadow-xl" wire:click="selectLottery({{ $lottery->id }})">
                <figure>
                    <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $lottery->name }}</h2>
                    <p>{{ $lottery->description }}</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-primary" wire:click="selectLottery({{ $lottery->id }})">View</button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
