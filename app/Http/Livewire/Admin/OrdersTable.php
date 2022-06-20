<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OrdersTable extends LivewireDatatable
{
    public $model = Order::class;

    public function builder()
    {
        return Order::query();
    }

    public function columns()
    {
        return [
            Column::checkbox(),
//            Column::name('order_number', 'user.name')->searchable()->label('# Order No'),
            Column::name('order_number')->label('Order No'),

            Column::callback(['user.id', 'user.first_name', 'user.last_name'], function ($userId, $last_name, $first_name) {
                return '<a href="'.route('admin.users.edit', $userId).'" class="flex items-center gap-1 text-sm text-primary hover:underline"> <span>'.$last_name.' '.$first_name.'</span>
                                </a>';
            })->exportCallback(function ($last_name, $first_name){
                return $last_name.' '.$first_name;
            })->searchable()->label('Customer'),

            Column::callback(['grand_total'], function ($grand_total) {
                return app_money_format($grand_total);
            })->label('Total'),

            Column::callback(['status'], function ($status) {
                return '<span class="rounded-lg p-1 badge badge-sm '.($status == 'completed' ? 'bg-success' : ($status == 'canceled' || $status == 'canceled' ? 'bg-error' : ($status == 'pending' ? 'bg-warning' : ($status == 'processing' ? 'bg-blue-500' : 'bg-secondary')))).'">'.$status.'</span>';
            })->exportCallback(function ($order_number){
                return $order_number;
            })->searchable()->label('Status'),

            DateColumn::name('created_at')
                ->label('Created at'),

            Column::callback(['id'], function ($id) {
                return view('livewire.admin.order.table-actions', ['id' => $id]);
            })->unsortable()->label('Action')->excludeFromExport()
        ];
    }


}
