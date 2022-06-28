<?php

namespace App\Http\Livewire\Admin\Affiliate;

use App\Enums\UserRole;
use App\Enums\WithdrawStatus;
use App\Models\User;
use App\Models\Withdrawrequest;
use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Internal\Service\DatabaseServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TransactionTable extends LivewireDatatable
{

    public $model = Transaction::class;

    public function builder()
    {
        return DB::table('transactions')
            ->join('users', 'users.id', '=', 'transactions.payable_id')
            ->select('*');
    }


    public function columns()
    {
        return [
            Column::callback(['users.id'], function ($id) {
                return '<div class="flex items-center">
                <div class="flex-shrink-0">
                    <img src="'.Storage::url('avatar.png').'"  class="rounded-full w-14" />
                </div>
                <div class="ml-2">
                    <div class="text-sm font-medium leading-5 text-gray-900">
                        '.$id.'
                    </div>
                </div>
            </div>';
            })->exportCallback(function ($id){
                return $id;
            })->searchable()->label('User'),

//            Column::callback(['amount'], function ($amount) {
//                return app_money_format($amount);
//            })->label('Amount'),

//            Column::callback(['status'], function ($status) {
//                return $status == WithdrawStatus::PENDING() ? 'Pending' : ($status == WithdrawStatus::CANCELED() ? 'Rejected' : ($status == WithdrawStatus::PAID() ? 'Paid' : ''));
//            })->label('Status'),

            DateColumn::name('created_at')
            ->format('j F, Y h:s:ia')
                ->label('Request Date')

        ];
    }

    public function getStatusProperty()
    {
//        $status = WithdrawStatus::options()->map(($re){
//            return $re;
//        });
//        return collect($status)->all();
    }
}
