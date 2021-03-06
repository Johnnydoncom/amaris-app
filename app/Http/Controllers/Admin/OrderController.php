<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Order;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $orders = Order::with('user');
        return view('admin.order.home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return Inertia::render('Admin/Orders/Show', [
            'order' => $order->load('user'),
            'orderItems' => $order->items->map(function ($item){
                $item['total'] = app_money_format($item->amount);
                $item['current_price'] = app_money_format($item->current_price);
                return $item;
            }),
            'status' => config('appstore.orderstatus')[$order->status],
            'delivery_address' => $order->delivery_address,
            'payment' => $order->payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.order.edit', [
            'order' => $order,
            'orderItems' => $order->items->map(function ($item){
                $item['total'] = app_money_format($item->amount);
                $item['current_price'] = app_money_format($item->current_price);
                return $item;
            }),
            'delivery_address' => $order->delivery_address,
            'payment' => $order->payment,
            'statuses' => config('appstore.orderstatus'),
            'customers' => User::role([UserRole::CUSTOMER, UserRole::AFFILIATE])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->withSuccess('Order Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->withSuccess('Order Deleted');
    }
}
