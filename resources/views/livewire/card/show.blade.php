<div>
    {{--    <x-slot name="title">{{$product->title}}</x-slot>--}}
    <div class="py-1 relative mx-0 product bg-white" id="single-product" x-data="order()">


        <div class="relative bg-primary text-white bg-cover bg-clip-padding w-full -mb-16 sm:mb-14 pb-5 sm:pb-0 after:absolute after:inset-0 bg-page-heading-pattern">
            <div class="container py-6 relative z-10">
                <div class="grid grid-cols-1 sm:grid-cols-5 gap-0 sm:gap-8 items-center justify-center sm:justify-start">
                    <div class="sm:col-span-1" style="perspective: 25em;">
                        <div class="product-image mb-2 sm:-mb-20 z-10 rounded-xl border-primary relative">
                            <img src="{{ $product->getFirstMediaUrl('featured_image', 'thumb') }}" alt="{{$product->title}}" class="w-32 rounded-xl object-contain sm:w-full mx-auto" >
                            <img src="{{Storage::url('gift-pin.png')}}" class="h-3 sm:h-4 top-2 sm:top-3 absolute inset-x-0 mx-auto">
                        </div>
                    </div>
                    <div class="sm:col-span-3 py-2 sm:py-6 text-center sm:text-left">
                        <h1 class="text-white text-2xl sm:text-3xl title-font font-semibold mb-4 sm:mb-8 line-clamp-2">{{$product->title}}</h1>
                        <div class="mb-2 text-xs sm:text-sm flex gap-4 items-center justify-center sm:justify-start">
                            <span class="flex gap-1 items-center">
                                <img src="{{ asset('vendor/blade-coreui-icons/cif-'.Str::lower($product->country->iso2).'.svg') }}" class="h-6 w-6" />
                                 {{$product->country->name}}</span>
                            <span class="flex gap-1 items-center"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg> Instant Delivery</span>
                        </div>
                        <p class="text-xs sm:text-sm">
                            {{$product->subheading}}
                        </p>
                    </div>
                    <div class="sm:col-span-1 order-first sm:order-last ">
                        <button class="btn btn-sm rounded-full float-right items-center justify-center sm:float-none bordered btn-outline-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                             Add favorite
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <form method="post" wire:submit.prevent="save()">
            <div class="container grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 ">
                <div class="sm:col-span-2">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">

                        @foreach($product->variations as $variation)
                            <div class="card card-body flex-row bg-white group group-hover:cursor-pointer cursor-pointer p-4 shadow-xl w-full rounded-3xl hover:shadow-lg dark:border-transparent transition-shadow" :class="{'border border-2 border-primary': variation == {{$variation->id}}}">
                                <label class="flex flex-row gap-4 items-center w-full cursor-pointer" for="variation-{{$variation->id}}" @click="calculatedAmount">
                                    <img src="{{$product->featured_img_thumb}}" alt="{{$variation->name}}" class="w-10 h-10 rounded-xl">
                                    <div class="flex justify-between gap-4 w-full font-semibold">
                                        <div class="text-xs sm:text-sm line-clamp-2">{{$variation->name}}</div>
                                        <div class="text-xs text-red-600 font-semibold">
                                            {{ currency($variation->price, session()->has('cart') ? session('cart')['currency'] : null, null, true)}}
                                        </div>
                                    </div>
                                    <input id="variation-{{$variation->id}}" type="radio" class="hidden" value="{{$variation->id}}" x-model="variation">
                                </label>
                            </div>

                        @endforeach
                    </div>
                    @error('variation')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <aside class="space-y-4">
                    <h2 class="font-semibold text-xl text-primary">Your Cart</h2>
                    <x-card class="card card-body bg-white shadow-xl w-full">
                        <div class="form-control ">
                            <x-label value="Quantity" class="font-semibold mb-2" />
                            <x-floating-input label="Quantity" @click="if(quantity<1){quantity=1;}" id="quantity" type="number" x-model="quantity" wire:model.defer="quantity" min="1" wrapperClass="w-full" placeholder="" />
                        </div>
                    </x-card>
                    <x-card class="card card-body bg-white shadow-xl w-full">
                        <div class="flex justify-between gap-4">
                            <h3 class="font-semibold">Total</h3>
                            <div>
                               <span class="text-primary font-semibold text-xl">
{{--                                   {{ currency($variation->price, session()->has('cart') ? session('cart')['currency'] : null, null, true)}}--}}
                                   {{ currency()->getCurrency()['symbol']}} <span x-text="calculatedAmount">0</span>
                               </span>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <x-button class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="save" x-bind:disabled="quantity<1" type="submit">Buy Now</x-button>
                    </x-card>
                </aside>
            </div>

        </form>



        <section class="description sm:mt-6 mt-4 pt-4 pb-14">
            <div class="container">
                <div class="flex mb-4 border-b-2 border-gray-200 gap-0">
                    <div class="flex-groww pt-2 text-sm sm:text-lg active border-b-2 text-primary border-primary rounded-t-xl leading-none">Description</div>
                </div>

                <div>
                    <div class="text-sm leading-relaxed">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </section>

        @if($related->count())
            <section class="mb-0 mt-4">
                <div class="container">
                    <h2 class="font-semibold mb-4 text-md sm:text-xl">You may also like</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach($related as $rp)
                            <x-card.layout-two :product="$rp" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <script>
            function order() {
                return {
                    quantity: @entangle('quantity').defer,
                    amount: @entangle('amount'),
                    variations: @js($variations),
                    variation: @entangle('variation').defer,
                    swiper: null,
                    personal_message: @entangle('personal_message').defer,
                    recipient_name:@entangle('recipient_name').defer,
                    tab: 'description',
                    delivery_type:@entangle('delivery_type'),
                    personal_message_limit: 250,
                    async formatMoney(val){
                        return new Intl.NumberFormat('en-US',
                            { currency: '{{currency()->getUserCurrency()}}' }
                        ).format(val);
                    },
                    async calculatedAmount(){

                        let variation = this.variations.filter((item) => {
                            return this.variation == item.id;
                        });
                        // console.log(variation[0].price)
                        return this.formatMoney(variation[0].converted_price*this.quantity);
                    },
                    get filteredDesigns() {
                        if (this.design_category == null || this.design_category == '') {
                            return this.designs;
                        }
                        return this.designs.filter((item) => {
                            return this.design_category == item.message_category_id;
                        });
                    }
                }
            }
        </script>
    </div>


    @push('styles')
        <link rel="stylesheet" href="{{ mix('css/swiper-bundle.min.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ mix('js/swiper-bundle.js')}}"></script>
        <script>
            (() => {
                const initSlider = () => {
                    var gallerySwiper = new Swiper('.gallery-slider', {
                        slidesPerView: 1.3,
                        lazy:true,
                        grabCursor: true,
                        loop: true,
                        freeMode: true,
                        spaceBetween: 10,
                        centeredSlides:true,
                        scrollbar: {
                            el: '.swiper-scrollbar',
                            hide: true
                        },
                        autoplay:{
                            delay: 5000,
                            disableOnInteraction: false
                        },
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true
                        },
                        navigation:false,
                        breakpoints: {
                            991: {
                                slidesPerView: 1,
                                spaceBetween: 10,
                                height: 350
                            }
                        }
                    })
                }

                initSlider();

            })();
        </script>

    @endpush

</div>
