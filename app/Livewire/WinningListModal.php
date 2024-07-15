<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class WinningListModal extends Component
{
    public $winningList = null;
    public $modalVisible = false;

    #[On('view-more')]
    public function updateModalData($winningListArray)
    {
        $this->winningList = $winningListArray;
        $this->modalVisible = true;
    }

    public function render()
    {
        return view('livewire.winning-list-modal');
    }
}
