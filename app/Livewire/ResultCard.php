<?php

namespace App\Livewire;

use App\Models\Lottery;
use App\Models\PrintedList;
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
        $this->results = $lottery->results()->where('is_published', 1)->latest()->get();
    }

    public function startNewRound()
    {
        LotteryResultService::startLotteryRound($this->lotteryId);
        $this->dispatch('lotteryRoundStarted', $this->lotteryId);
    }

    public function viewMore($resultId)
    {
        $winningList = PrintedList::select('winning_list')->where('result_id', $resultId)->first();
        // dd($resultId, $winningList);
        $winningListArray = json_decode($winningList->winning_list, true);
        // dd($winningListArray);
        $this->dispatch('view-more', winningListArray : $winningListArray)->to(WinningListModal::class);
    }

    public function render()
    {
        return view('livewire.result-card');
    }
}
