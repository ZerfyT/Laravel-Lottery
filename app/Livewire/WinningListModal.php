<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class WinningListModal extends Component
{
    public $winningList = null;

    // #[On(('view-more'))]
    // public function updateModalData($winningListArray)
    // {
    //     // dd($winningListArray);
    //     $this->winningList = $winningListArray;
    //     // $this->placesCount = count($winningList);
    //     $this->dispatch('show-modal');
    // }

    public function render()
    {
        return view('livewire.winning-list-modal');
    }
}
