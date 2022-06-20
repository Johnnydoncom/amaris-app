<div class="bg-white">
    <div
        class="container"
        x-data="checkout()"
    >
        <h2 class="text-center font-semibold text-2xl sm:text-3xl py-6">Checkout</h2>

        <form class="grid grid-cols-1 sm:grid-cols-3 gap-6 pb-14" id="checkoutForm" method="post" wire:submit.prevent="finalize">
            <div class="col-span-2">
                @csrf
                <x-card class="card bg-white shadow-xl h-full">
                    <div class="card-body">
                          <div class="grid rid-cols-1 lg:grid-cols-2 gap-8">
                               <div class="form-control">
                                   <x-floating-input id="first_name" label="First Name" name="first_name" wrapperClass="" type="text" placeholder="First Name" :value="old('first_name')" wire:model.defer="first_name" required autofocus />

                               </div>
                              <div class="form-control">
                                  <x-floating-input id="last_name" wire:model.defer="last_name" label="Last Name" name="last_name" wrapperClass="" type="text" placeholder="" :value="old('last_name')" required autofocus />
                              </div>

                              <div class="form-control ">
                                  <x-floating-input id="phone" wire:model.defer="phone" label="Phone" name="phone" wrapperClass="" type="text" placeholder="" :value="old('phone')" />
                              </div>
                              <div class="form-control">
                                  <x-floating-input id="email" label="email" wire:model.defer="email" name="email" wrapperClass="" type="email" placeholder="" :value="old('email')" />
                              </div>

                              <div class="form-control sm:col-span-2">
                                  <x-floating-input id="company" label="Company Name (Optional)" wire:model.defer="company_name" name="company" wrapperClass="" type="text" placeholder="" :value="old('company')" />
                              </div>

                              <div class="form-control col-span-2">
                                  <x-floating-input id="address_line_1" label="Street Address" wire:model.defer="address_line_1" name="address_line_1" wrapperClass="" type="text" placeholder="" :value="old('address_line_1')" />
                              </div>
                              <div class="form-control col-span-2">
                                  <x-floating-input id="address_line_1" label="Apartment, suite, etc" name="address_line_2" wire:model.defer="address_line_2" wrapperClass="" type="text" placeholder="" :value="old('address_line_2')" />
                              </div>
                              <div class="form-control">
                                  <x-floating-select id="country" :label="__('Country')" name="country" wrapperClass="" wire:model="country" placeholder="__('Country')">
                                      <option value="">Select</option>
                                      @foreach($countries as $ctry)
                                          <option value="{{$ctry->id}}" @if(old('country_id')==$ctry->id) selected @endif>{{$ctry->name}}</option>
                                      @endforeach
                                  </x-floating-select>
                              </div>

                              <x-floating-select id="region" wrapperClass="" label="Region" type="text" placeholder="Region" class="w-full" wire:model="state" autofocus autocomplete="state" wire:loading.attr="disabled" wire:target="country">
                                  <option value="" selected>Choose state</option>
                                  @forelse($states as $st)
                                      <option value="{{$st->id}}">{{$st->name}}</option>
                                  @empty
                                  @endforelse
                              </x-floating-select>

                              <x-floating-select id="city" wrapperClass="" label="City" type="text" placeholder="City" class="w-full" wire:model.defer="city" autofocus autocomplete="city" wire:loading.attr="disabled" wire:target="state">
                                  <option value="" selected>Choose city</option>
                                  @forelse($cities as $cty)
                                      <option value="{{$cty->id}}">{{$cty->name}}</option>
                                      @empty
                                      @endforelse
                              </x-floating-select>

                              <div class="form-control">
                                  <x-floating-input id="zipcode" label="ZIP" wire:model.defer="zipcode" name="zipcode" wrapperClass="" type="text" placeholder="" :value="old('zipcode')" />
                              </div>

                          </div>
                    </div>
                </x-card>
            </div>
            <div class="col-span-1">
                <x-card class="card bg-white sticky top-0 shadow-lg h-full">
                    <div class="card-body">
                        <div class="flex gap-4 justify-between items-center w-full">
                            <div class="flex gap-4 items-center">
                                <img src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" class="w-16 h-16 rounded-xl object-cover">

                                <div class="text-xs sm:text-sm">{{$product->title}}</div>
                            </div>

                            <div class="text-xs sm:text-sm text-primary font-semibold">
                                {{ currency($product->regular_price, null, null, true)}}
                                <div class="text-xs sm:text-sm text-right">x {{ $quantity }}</div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="flex justify-between gap-4">
                            <h3 class="font-semibold">Total</h3>
                            <div>
                               <span class="text-primary font-semibold text-xl">
                                   {{ currency($total, null, null, true)}}
                               </span>
                            </div>
                        </div>

                        <x-button class="btn btn-primary btn-block" wire:loading.class="loading" wire:loading.attr="disabled" wire:target="finalize">Place Order</x-button>

                        @if(1>3)
                        <div class="pt-4">
                            @if($payment_gateway == 'paystack')
                                <button id="paystackBtn" class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="finalize" wire:loading.attr="disabled">Pay Now</button>

                            @elseif($payment_gateway == 'stripe')
                                <div class="mb-6">
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div>

                                <button id="stripeBtn" class="btn btn-primary btn-block" wire:loading.class="loading" wire:loading.attr="disabled" wire:target="finalize">Pay Now</button>
                            @endif
                        </div>
                        @endif
                    </div>
                </x-card>
            </div>
        </form>
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
