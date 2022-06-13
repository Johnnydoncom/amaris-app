<x-admin-layout>
    <x-slot name="title">{{ __('Edit Order - '.$order->id) }}</x-slot>

    <div>
        <div class="flex w-full gap-4 mt-3">
            <div class="w-3/4">
                <x-card class="card bg-white rounded-sm">

                    <form method="post" action="{{ route('admin.orders.update', $order->id) }}" class="card-body">
                        @csrf
                        @method('PATCH')
                        <div class="flex">
                            <h2 class="font-semibold text-md"> Order #{{$order->order_number}} details </h2>

                            <a href="{{route('admin.orders.index')}}" class="ml-auto btn btn-primary btn-xs">Back to Orders</a>
                        </div>

                        <div class="grid grid-cols-2 gap-4 lg:gap-16 mt-4 w-full">
                            <x-card>
                                <div class="card-body p-0 sm:p-2">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-bold">Order Nº {{$order->order_number }}</h3>
                                        @switch($order->status)
                                            @case('pending')
                                            <span class="rounded-full p-2 bg-yellow-400 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                                            @break
                                            @case('unsent')
                                            <span class="rounded-full p-2 bg-red-400 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </span>
                                            @break
                                            @case('sending')
                                            <span class="rounded-full p-2 bg-gray-800 text-white">
                               <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            </span>
                                            @break
                                            @case('sent')
                                            <span class="rounded-full p-2 bg-green-600 text-white">
                               <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                                            @break
                                            @case('canceled')
                                            <span class="rounded-full p-2 bg-red-500 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </span>
                                            @break
                                            @case('refunded')
                                            <span class="rounded-full p-2 bg-red-500 text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </span>
                                            @break
                                        @endswitch
                                    </div>
                                    <div class="divider"></div>

                                    <p class="text-sm flex justify-between">
                                        Payment Status: <span>@if($order->payment_status == \App\Enums\PaymentStatus::PENDING) Waiting payment @elseif($order->payment_status == \App\Enums\PaymentStatus::PAID) Paid @else Canceled @endif</span>
                                    </p>
                                    <p class="text-sm flex justify-between">
                                        Created on: <span>{{$order->created_at}}</span>
                                    </p>
                                    <p class="text-sm flex justify-between">
                                        Expired after: <span>{{$order->payment_expires_at}}</span>
                                    </p>

                                    <div class="divider"></div>

                                    <p class="text-sm flex justify-between">
                                        Original Price Total: <span class="font-bold">{{$order->items[0]->final_amount}}</span>
                                    </p>

                                    <div class="divider"></div>
                                    <p class="text-lg flex justify-between">
                                        Total: <span class="font-bold">{{ $order->grand_total }}</span>
                                    </p>

                                    @if($order->payment_expires_at && !$order->payment_expires_at->isPast())
                                        <x-button class="btn btn-primary btn-block mt-8" wire:loading.class="loading" wire:target="pay">Pay Now</x-button>
                                    @endif

                                </div>
                            </x-card>
                            <div class="">
                                <h3 class="font-semibold mb-3">Actions</h3>

                                <div class="form-control w-full max-w-xs mb-4">
                                    <x-floating-select label="Status" class="select select-bordered w-full max-w-xs select-sm" name="status">
                                        @foreach($statuses as $key => $status)
                                        <option value="{{$key}}" @if($order->status==$key) selected @endif>{{$status}}</option>
                                        @endforeach
                                    </x-floating-select>
                                </div>

                                <div class="form-control w-full max-w-xs">
                                    <x-floating-select name="user_id" label="Customer" class="select select-bordered w-full max-w-xs select-sm">
                                        <option disabled>Select Customer</option>
                                        @foreach($customers as $key => $customer)
                                        <option value="{{$customer->id}}" @if($order->user_id==$customer->id) selected @endif>{{$customer->name}}</option>
                                        @endforeach
                                    </x-floating-select>
                                </div>

                            </div>
                        </div>


                        <div class="flex justify-between mt-8">
                            <a href="#" class="text-error underline" onclick="event.preventDefault();
                                                document.getElementById('deleteForm').submit();">Move to Trash</a>
                            <x-button class="btn btn-primary">Update</x-button>
                        </div>
                    </form>
                    <form method="POST" id="deleteForm" action="{{ route('admin.orders.destroy', $order->id) }}" class="hidden" style="display: none">
                        @csrf
                        @method('DELETE')
                    </form>
                </x-card>

                @foreach($order->items as $item)
                        @if($item->recharge)
                            <x-card class="grid grid-cols-3 sm:grid-cols-4 gap-4 items-center">
                                <div class="col-span-2">
                                    <div class="relative flex flex-row space-y-0 space-x-3  p-0 w-full">
                                        <div class="bg-white grid place-items-center">
                                            <img src="{{$item->recharge->operator->getFirstMediaUrl('logo')}}" class="rounded-xl w-full sm:w-14" alt="{{$item->recharge->operator->brand}}"  />
                                        </div>
                                        <div class="bg-white flex flex-col p-0 items-start">
                                            <div class="block relative w-full">
                                                <p class="text-xs sm:text-sm py-1">{{$item->recharge->operator->brand}} {{$item->recharge->operator->country->name}}</p>
                                                <p class="font-light text-xs sm:text-sm text-gray-400 mt-0">{{ $item->value }} {{ $item->currency }} {{ $item->recharge->type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-xs sm:text-sm text-primary font-semibold py-1">{{$item->currency}} {{$item->value}}</p>
                                </div>

                                <div class="col-span-3 sm:col-span-1 text-right">
                                    <span class="bg-gray-100 rounded-full px-4 py-1 text-xs">x{{ $item->quantity }}</span>
                                </div>

                            </x-card>
                        @else
                            <x-card class="grid grid-cols-3 sm:grid-cols-4 gap-4 items-center">
                                <div class="col-span-2">
                                    <div class="relative flex flex-row space-y-0 space-x-3  p-0 w-full">
                                        <div class="w-1/3 bg-white grid place-items-center">
                                            <img src="{{$item->product->featured_img_thumb}}" class="rounded-xl w-full sm:w-28" alt="{{$item->product->title}}"  />
                                        </div>
                                        <div class="w-2/3 bg-white flex flex-col p-0 items-start">
                                            <div class="block relative w-full">
                                                <p class="text-xs sm:text-sm py-1">{{ $item->name }}</p>
                                                <p class="font-light text-xs sm:text-sm text-gray-400 mt-1">QTY: {{ $item->quantity }}</p>
                                                <div class="font-light text-xs sm:text-sm text-gray-400 mt-1">
                                                    @if($item->product->sales_price > 0)
                                                        <p class="text-sm sm:text-sm font-medium text-gray-900">{{$item->product->formatted_sales_price}}</p>
                                                    @endif

                                                    <p class="@if($item->product->sales_price > 0) text-gray-500 text-xs sm:text-sm line-through @else text-gray-900 text-xs sm:text-sm font-normal @endif">
                                                        {{ $item->product->formatted_regular_price }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="uppercase text-sm w-full">
                                        @if($order->status==='order_placed' || $order->status==='processing' || $order->status==='shipped' || $order->status==='out_for_delivery')
                                            <p class="badge badge-info uppercase badge-xs">
                                                {{ ucwords($order->status) }}
                                            </p>
                                        @elseif($order->status==='delivered' || $order->status==='completed')
                                            <p class="badge badge-success uppercase badge-xs">
                                                {{ ucwords($order->status) }}
                                            </p>
                                        @else
                                            <p class="badge badge-error uppercase badge-xs">
                                                {{ ucwords($order->status) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-3 sm:col-span-1">
                                    <div class="flex flex-col flex-wrap gap-2">
                                        <form action="{{ route('account.order.cancelItem', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <x-button class="btn btn-primary btn-block btn-xs">
                                                <span class='flex-1'>Cancel Item</span>
                                            </x-button>
                                        </form>
                                        @if($item->product->type==='digital')
                                            <a href="{{route('account.order.download', $item->order_number)}}" class="btn btn-secondary btn-block btn-xs rounded-none">
                                                <span class='flex-1'>Download Item</span>
                                            </a>
                                        @else
                                            <a href="/" class="btn btn-secondary btn-block btn-xs rounded-none">
                                                <span class='flex-1'>Track My Item</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </x-card>
                        @endif
                    @endforeach
            </div>
        </div>
    </div>

</x-admin-layout>
