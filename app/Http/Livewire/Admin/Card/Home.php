<?php

namespace App\Http\Livewire\Admin\Card;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.admin.card.home')->layout('layouts.admin');
    }
}
