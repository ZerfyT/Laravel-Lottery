<?php

namespace App\Livewire;

use App\Models\Lottery;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
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

    public function generateTickets($id)
    {

    }

    // public function placeholder(array $params = [])
    // {
    //     return view('livewire.placeholders.skeleton-lottery-page', $params);
    // }

    public function render()
    {
        return view('livewire.lottery-page');
    }
}
