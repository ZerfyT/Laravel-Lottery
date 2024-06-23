<?php

namespace App\Livewire;

use App\Models\Lottery;
use Livewire\Component;

class LotteryPage extends Component
{
    public $lotteries;

    public function mount()
    {
        $this->lotteries = Lottery::select('id', 'name', 'description')->get();
    }

    public function selectLottery($id)
    {
        $this->dispatch('selectLottery', $id);
    }

    public function render()
    {
        return view('livewire.lottery-page');
    }
}
