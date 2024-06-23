<?php

namespace App\Livewire;

use App\Models\Lottery;
use Livewire\Attributes\On;
use Livewire\Component;

class ResultCard extends Component
{
    public $results;

    #[On('selectLottery')]
    public function getResult($lotteryId)
    {
        $lottery = Lottery::find($lotteryId);
        $this->results = $lottery->results()->get();
    }

    public function render()
    {
        return view('livewire.result-card');
    }
}
