<?php

namespace App\Console\Commands;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OrdersCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check pending orders and update order status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Order::wherePaymentStatus(PaymentStatus::PENDING)->whereNotNull('payment_expires_at')->whereDate('payment_expires_at','<=',Carbon::now())->update([
            'payment_status' => PaymentStatus::CANCELED,
            'status' => OrderStatus::CANCELED
        ]);
    }
}
