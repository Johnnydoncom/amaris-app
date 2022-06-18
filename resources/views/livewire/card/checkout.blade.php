<div class="bg-white">
    <div
        class="container"
        x-data="checkout()"
    >
        <h2 class="text-center font-semibold text-2xl sm:text-3xl py-6">Checkout Gift Card</h2>

        <div class="max-w-2xl mx-auto">
            <x-card class="card bg-white shadow-xl mb-8 h-full">
                <div class="card-body">
                    <h3 class="uppercase text-xs sm:text-lg">{{ $product->title }}</h3>
                    <div class="divider my-0"></div>

                    <div class="flex gap-4 justify-between items-center w-full">
                        <div class="flex gap-4 items-center">
                            <img src="{{$product->featured_img_thumb}}" alt="{{$variation->name}}" class="w-16 h-16 rounded-xl object-cover">

                            <div class="text-xs sm:text-sm">{{$variation->name}}</div>
                        </div>

                        <div class="text-xs sm:text-sm text-primary font-semibold">
                            {{ currency($variation->price, null, null, true)}}
                        </div>

                        <div class="text-xs sm:text-sm bg-gray-100 rounded-full px-4 py-1">x {{ $quantity }}</div>
                    </div>
                    <div class="divider my-6"></div>
                    <div class="flex justify-between gap-4 ">
                        <h3 class="font-semibold">Total</h3>
                        <div>
                           <span class="text-primary font-semibold text-xl">
                               {{ currency($total, null, null, true)}}
                           </span>
                        </div>
                    </div>

                    <div class="mt-4">
                            @if($payment_gateway == 'paystack')
                                <button id="paystackBtn" class="btn btn-primary btn-block" wire:loading.class="loading" wire:loading.attr="disabled">Pay Now</button>

                            @elseif($payment_gateway == 'stripe')
                                <div class="mb-6">
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>

                                <button id="stripeBtn" class="btn btn-primary btn-block" wire:loading.class="loading" wire:loading.attr="disabled">Pay Now</button>
                            @endif
                        </div>


                    @if(1>3)
                        <div class="py-0 my-0 mt-0 relative">
                            <h3 class="uppercase text-xs sm:text-lg">{{ $product->title }}</h3>
                            <div class="divider mt-0"></div>


                            <div class="card bg-white mb-4 rounded-none">
                                <div class="flex justify-between mb-2 items-center">
                                    <span class="font-normal text-md">Unit Price</span>
                                    <span class="font-semibold text-md">{{ app_money_format($cart['amount'],$cart['currency'], currency()->getUserCurrency()) }}</span>
                                </div>
                                <div class="flex justify-between mb-2 items-center">
                                    <span class="font-normal text-md">Quantity</span>
                                    <span class="font-semibold text-md">{{ $cart['quantity'] }}</span>
                                </div>
                                <div class="flex justify-between mb-2 items-center">
                                    <span class="font-normal text-md">Subtotal</span>
                                    <span class="font-semibold text-md">{{ app_money_format($subtotal,currency()->getUserCurrency()) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-normal text-md">Shipping Fees</span>
                                    <span class="font-semibold text-md">{{ app_money_format($shippingCost, currency()->getUserCurrency()) }}</span>
                                </div>
                                <div class="divider my-2"></div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-lg">Total</span>
                                    <span class="text-primary font-bold text-lg">{{ app_money_format($total, currency()->getUserCurrency()) }}</span>
                                </div>

                            </div>

                            <div class="uppercase text-xs mt-0 sm:mt-10">
                                <div class="flex justify-between items-center w-full">
                                    <h2 class="uppercase sm:text-lg">Customer Details</h2>
                                </div>
                                <div class="divider my-0"></div>
                            </div>
                            <div class="card bg-white mb-4 rounded-none">
                                <div class="card bg-white rounded-sm">
                                    <div class="p-0">
                                        <h2 class="font-semibold text-sm">{{Auth::user()->name}}</h2>
                                        <div class="font-light text-sm w-8/12">{{Auth::user()->email}}</div>
                                        <div class="font-light text-sm mt-1">{{Auth::user()->phone}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="uppercase text-xs mt-0 sm:mt-10">
                                <div class="flex justify-between items-center w-full">
                                    <h2 class="uppercase sm:text-lg">Discount Code</h2>
                                </div>
                                <div class="divider my-0"></div>
                            </div>

                            <div class="space-y-4 flex-col">
                                <div class="max-w-sm">
                                    <x-floating-input wire:model.defer="coupon" label="Enter your coupon code, if any" wrapperClass="w-full" placeholder="Enter your coupon code, if any"  />
                                </div>
                                <x-button class="btn btn-secondary">Apply Coupon</x-button>
                            </div>

                            <div class="uppercase text-xs mt-0 sm:mt-10">
                                <div class="flex justify-between items-center w-full">
                                    <h2 class="uppercase sm:text-lg">Payment</h2>
                                </div>
                                <div class="divider my-0"></div>
                            </div>
                            <div class="">
                                <div class="flex justify-startt">

                                    <a x-transition :class="{ 'active font-semibold border-t border-l border-r border-b-0': tab === 'card' }" x-on:click.prevent="tab = 'card'" class="flex flex-grow justify-center gap-2 items-center py-2 px-4 border-b" href="#">
                                        Credit/Debit Cards
                                    </a>
                                    <a x-transition :class="{ 'active font-semibold border-t border-l border-r border-b-0': tab === 'bacs' }" x-on:click.prevent="tab = 'bacs'" class="flex flex-grow justify-center gap-2 items-center py-2 px-4 border-b" href="#">
                                        Bank Transfer
                                    </a>
                                </div>
                                <div class="tab-content border-r border-l border-b p-2 sm:p-4" wire:ignore>
                                    <div x-show="tab === 'card'" class="">
                                        <div class="">
                                            @if($payment_gateway == 'paystack')
                                                <button id="paystackBtn" class="btn btn-primary mb-2" wire:loading.class="loading" wire:loading.attr="disabled">Pay with Credit/Debit Card</button>

                                            @elseif($payment_gateway == 'stripe')
                                                <div class="my-4">
                                                    <div id="card-element">
                                                        <!-- A Stripe Element will be inserted here. -->
                                                    </div>
                                                    <!-- Used to display form errors. -->
                                                    <div id="card-errors" role="alert"></div>
                                                </div>

                                                <button id="stripeBtn" class="btn btn-primary mb-2" wire:loading.class="loading" wire:loading.attr="disabled">Pay Now</button>
                                            @endif
                                        </div>
                                    </div>

                                    <div x-show="tab === 'bacs'" x-transition>
                                        Bank transfer
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif
                </div>
            </x-card>
        </div>
    </div>

    <script>
        function checkout() {
            return {
                tab: @entangle('payment_method').defer
            }
        }
    </script>

    @if($payment_gateway == 'paystack')
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
                        amount: '{{currency($total,currency()->getUserCurrency(),null,false) * 100}}',
                        currency: '{{$currency}}',
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
    @elseif($payment_gateway == 'stripe')
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


            // Create an instance of the card Element.
            // var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            // card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            // card.addEventListener('change', function(event) {
            //     var displayError = document.getElementById('card-errors');
            //     if (event.error) {
            //         displayError.textContent = event.error.message;
            //     } else {
            //         displayError.textContent = '';
            //     }
            // });










            {{--const stripBtn = document.getElementById('stripeBtn');--}}
            {{--stripBtn.addEventListener("click", function(event) {--}}
            {{--    event.preventDefault();--}}

            {{--    var handler = StripeCheckout.configure({--}}
            {{--        key: "{{setting('stripe_key')}}", // your publisher key id--}}
            {{--        locale: 'auto',--}}
            {{--        token: function(token) {--}}
            {{--            // You can access the token ID with `token.id`.--}}
            {{--            // Get the token ID to your server-side code for use.--}}
            {{--            console.log('Token Created!!');--}}
            {{--            console.log(token)--}}
            {{--        // @this.finalize(result.token.id)--}}
            {{--            // $('#res_token').html(JSON.stringify(token));--}}
            {{--            --}}{{--$.ajax({--}}
            {{--            --}}{{--    url: '{{ url("payment-process") }}',--}}
            {{--            --}}{{--    method: 'post',--}}
            {{--            --}}{{--    data: {--}}
            {{--            --}}{{--        tokenId: token.id,--}}
            {{--            --}}{{--        amount: amount--}}
            {{--            --}}{{--    },--}}
            {{--            --}}{{--    success: (response) => {--}}
            {{--            --}}{{--        console.log(response)--}}
            {{--            --}}{{--    },--}}
            {{--            --}}{{--    error: (error) => {--}}
            {{--            --}}{{--        console.log(error);--}}
            {{--            --}}{{--        alert('Oops! Something went wrong')--}}
            {{--            --}}{{--    }--}}
            {{--            --}}{{--})--}}
            {{--        }--}}
            {{--    });--}}
            {{--    handler.open({--}}
            {{--        name: 'Demo Site',--}}
            {{--        description: '2 widgets',--}}
            {{--        amount: {{$total*100}}--}}
            {{--    });--}}






            {{--    // stripe.createToken(card).then(function(result) {--}}
            {{--    //     if (result.error) {--}}
            {{--    //         // Inform the user if there was an error.--}}
            {{--    //         var errorElement = document.getElementById('card-errors');--}}
            {{--    //         errorElement.textContent = result.error.message;--}}
            {{--    //     } else {--}}
            {{--    //         // Send the token to your server.--}}
            {{--    //         @this.finalize(result.token.id)--}}
            {{--    //         // alert(1)--}}
            {{--    //     }--}}
            {{--    // });--}}
            {{--});--}}
        </script>
    @endif
</div>


@push('scriptss')
    <script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('pk_test_51L4gM4HPfoAuKwnmFouS5lTErlK9ZFYtE8w7EdyEVozXoWsy9o1U776PwmfnO1CgVJbdGjNLolAD0dnr3HCzAKlf00Cy0LHN3p');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        // base: {
        //     color: '#32325d',
        //     lineHeight: '18px',
        //     fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        //     fontSmoothing: 'antialiased',
        //     fontSize: '16px',
        //     '::placeholder': {
        //         color: '#aab7c4'
        //     }
        // },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });



        const stripBtn = document.getElementById('stripeBtn');
        stripBtn.addEventListener("click", function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    // stripeTokenHandler(result.token);
                    alert(1)
                }
            });
        });

        function payWithStripe() {
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    alert(22)
                    // Send the token to your server.
                    // stripeTokenHandler(result.token);
                }
            });
        }

</script>
@endpush
