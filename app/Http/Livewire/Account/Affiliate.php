<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class Affiliate extends Component
{

    public function render()
    {
        return view('livewire.account.affiliate')->layout('layouts.account');
    }
}
