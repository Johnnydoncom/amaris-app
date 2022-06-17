<?php

namespace App\Http\Livewire\Admin\Card;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.admin.card.create')->layout('layouts.admin');
    }
}
