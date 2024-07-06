<?php

namespace App\Livewire;

use App\Models\Lottery;
use App\Services\LotteryResultService;
use Livewire\Attributes\On;
use Livewire\Component;

class ResultCard extends Component
{
    public $results;
    public $lotteryId;

    #[On('selectLottery')]
    #[On('lotteryRoundStarted')]
    public function getResult($lotteryId)
    {
        $this->lotteryId = $lotteryId;
        $lottery = Lottery::find($this->lotteryId);
        $this->results = $lottery->results()->get();
    }

    public function startNewRound()
    {
        LotteryResultService::startLotteryRound($this->lotteryId);
        $this->dispatch('lotteryRoundStarted', $this->lotteryId);
    }

    public function render()
    {
        return view('livewire.result-card');
    }
}
