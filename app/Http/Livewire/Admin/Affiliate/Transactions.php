<?php

namespace App\Http\Livewire\Admin\Affiliate;

use Bavix\Wallet\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.affiliate.transactions')->with([
            'transactions' => Transaction::paginate()
        ])->layout('layouts.admin');
    }
}
