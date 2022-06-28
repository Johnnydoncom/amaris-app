<?php

namespace App\Http\Livewire\Admin;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserVerification;
use Carbon\Carbon;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Dashboard extends Component
{
    public $recentOrders = [], $recentUsers=[], $verificationRequests=[], $totalRevenue=0, $userCount=0, $productsCount=0, $totalOrders=0, $pendingOrdersCount;

    public $cartDates = [];
    public $chartAmounts = [];

    public $chartId = 'salesChart';

    public $weeklySales = 0, $lastWeekSales=0, $salesPercentChange=0;

    public function mount(){

        $this->recentUsers = User::latest()->limit(5)->get();

        $this->verificationRequests = UserVerification::where('status','pending')->latest()->limit(5)->get();

        $this->recentOrders = Order::latest()->limit(5)->get()->map(function ($order){
            $order['date'] = $order->created_at->format('d-m-Y');
            $order['total'] = app_money_format($order->grand_total);
            return $order;
        });

        $this->totalOrders = Order::count();

        $this->pendingOrdersCount = Order::whereStatus('pending')->count();
        $this->productsCount = Product::count();

        // This week sales
        $sales = Order::wherePaymentStatus(PaymentStatus::PAID)->whereBetween('created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        )->get();

        $salesModel = $sales->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d M'); // grouping by days
        });

        $salesModel->each(function ($data, $key) {
            $this->cartDates[] = (string)$key;
            $this->chartAmounts[] = (string)$data->sum('grand_total');
        });
        $this->weekSales = $sales->sum('grand_total');

        // Last week sales
        $this->lastWeekSales = Order::wherePaymentStatus(PaymentStatus::PAID)->whereBetween('created_at',
            [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
        )->sum('grand_total');

        $this->salesPercentChange = $this->getPercentageChange($this->lastWeekSales, $this->weekSales);

        // This week signups
        $this->userCount = User::whereBetween('created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        )->count();
    }

    public function render()
    {

        $this->emit("refreshChartData-{$this->chartId}", [
            'salesData' => [
                'labels'=> implode(',', $this->cartDates),
                'dataset' => implode(',', $this->chartAmounts)
            ]
        ]);
        return view('livewire.admin.dashboard')->layout('layouts.admin');
    }

    public function getPercentageChange($oldNumber, $newNumber){
        $decreaseValue = $newNumber - $oldNumber;

        return number_format($oldNumber>0 ? ($decreaseValue / $oldNumber) * 100 : 0, 2);
    }
}
