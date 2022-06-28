<div>
{{--    <x-slot name="title">Orders</x-slot>--}}
    <div class="py-4 ">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-4">
            <x-card class="card rounded-xl">
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

                    <p class="text-sm flex justify-between mb-1">
                       <strong> Payment Status:</strong> <span class="text-xs 2xl:text-sm">@if($order->payment_status == \App\Enums\PaymentStatus::PENDING) Waiting payment @elseif($order->payment_status == \App\Enums\PaymentStatus::PAID) Paid @else Canceled @endif</span>
                    </p>
                    <p class="text-sm flex justify-between items-center mb-1">
                        <strong>Created on:</strong> <span class="text-xs 2xl:text-sm">{{$order->created_at}}</span>
                    </p>
                    <p class="text-sm flex justify-between items-center">
                        <strong>Expired after:</strong> <span class="text-xs 2xl:text-sm">{{$order->payment_expires_at}}</span>
                    </p>
                    <div class="divider"></div>

                    <p class="text-sm flex justify-between">
                        Original Price Total: <span class="font-bold">{{app_money_format($order->items[0]->final_amount,$order->currency)}}</span>
                    </p>

                    <div class="divider"></div>
                    <p class="text-lg flex justify-between">
                        Total: <span class="font-bold">{{ app_money_format($order->grand_total, $order->currency) }}</span>
                    </p>

                    @if($order->payment_status == \App\Enums\PaymentStatus::PENDING() && $order->payment_expires_at && !$order->payment_expires_at->isPast())
{{--                        <x-button class="btn btn-primary btn-block mt-8" wire:loading.class="loading" wire:target="pay">Pay Now</x-button>--}}
                            <div class="mt-8">
                                @if($order->payment_method == 'paystack')
                                    <x-button id="paystackBtn" class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="finalize" wire:loading.attr="disabled">Pay Now</x-button>

                                @elseif($order->payment_method == 'stripe')
                                    <div class="mb-6">
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>

                                    <x-button id="stripeBtn" class="btn btn-primary btn-block" wire:loading.class="loading" wire:loading.attr="disabled" wire:target="finalize">Pay Now</x-button>
                                @endif
                            </div>

                        <x-flash-messages />
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    @endif

                </div>
            </x-card>

            <div class="w-full col-span-2">
                @foreach($order->items as $item)
                    <x-card class="grid grid-cols-3 sm:grid-cols-3 gap-4 items-center">
                            <div class="col-span-2">
                                <div class="relative flex flex-row space-y-0 space-x-3  p-0 w-full">
                                    <div class="bg-white grid place-items-center">
                                        <img src="{{$item->product->featured_img_thumb}}" class="rounded-xl w-full sm:w-24" alt="{{$item->product->title}}"  />
                                    </div>
                                    <div class="bg-white flex flex-col p-0 items-start">
{{--                                        <div class="block relative w-full">--}}
                                            <h6 class="text-xs sm:text-sm py-1">
                                                @if($item->variation)
                                                <strong>{{$item->variation->name}}</strong> ({{$item->product->title}})
                                                @else
                                                    <strong>{{$item->product->title}}</strong>
                                                @endif
                                            </h6>
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-xs sm:text-sm text-primary font-semibold py-1">
                                    {{app_money_format($item->value,$item->currency )}}<br>
                                    <span class="bg-gray-100 rounded-full px-4 py-1 text-xs">x{{ $item->quantity }}</span>
                                </p>
                            </div>

                        </x-card>
                @endforeach
            </div>
        </div>
    </div>



    @if($order->payment_expires_at && !$order->payment_expires_at->isPast())

        @if($order->payment_method == 'paystack')
            <script src="https://js.paystack.co/v2/inline.js"></script>
            <script>
                document.addEventListener('livewire:load', function () {

                    const paystackBtn = document.getElementById('paystackBtn');
                    paystackBtn.addEventListener("click", payWithPaystack, false);

                    function payWithPaystack(e) {
                        e.preventDefault();

                        const paystack = new PaystackPop();
                        paystack.newTransaction({
                            key: '{{setting('paystack_key')}}',
                            email: '{{Auth::user()->email}}',
                            amount: '{{currency($order->grand_total,$order->currency,null,false) * 100}}',
                            currency: '{{$order->currency}}',
                            onSuccess: (transaction) => {
                                // Payment complete! Reference: transaction.reference
                                // console.log(transaction)

                            @this.finalize(transaction.reference)
                            },
                            onCancel: () => {
                                // user closed popup
                                alert('Transaction was not completed, window closed.');
                            }
                        });
                    }
                });
            </script>
        @elseif($order->payment_method == 'stripe')
            {{--        <script src="https://checkout.stripe.com/checkout.js"></script>--}}

            <script src="https://js.stripe.com/v3/"></script>
            <script>
                var stripe = Stripe('{{setting('stripe_key')}}');
                var checkoutButton = document.getElementById('stripeBtn');

                checkoutButton.addEventListener('click', function() {
                    stripe.redirectToCheckout({
                        // Make the id field from the Checkout Session creation API response
                        // available to this file, so you can provide it as argument here
                        sessionId: '{{$stripe_session}}'
                    }).then(function (result) {
                        console.log(result);
                        // If `redirectToCheckout` fails due to a browser or network
                        // error, display the localized error message to your customer
                        // using `result.error.message`.
                    });
                });
            </script>
        @endif

    @endif
</div>
