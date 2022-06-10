<div>
{{--    <x-slot name="title">{{$product->title}}</x-slot>--}}
    <div class="py-1 relative mx-0 product bg-white" id="single-product" x-data="order()">
        <div class="bg-primary text-white bg-cover w-full -mb-16 sm:mb-14 pb-5 sm:pb-0" style="background-image: url({{Storage::url('')}})">
            <div class="container py-6">
                <div class="grid grid-cols-1 sm:grid-cols-5 gap-0 sm:gap-8 items-center justify-center sm:justify-start">
                    <div class="sm:col-span-1" style="perspective: 25em;">
                        <div class="product-image mb-2 sm:-mb-20 z-10 rounded-xl border-primary relative">
                            <img src="{{ $product->getFirstMediaUrl('featured_image', 'thumb') }}" alt="{{$product->title}}" class="w-32 rounded-xl object-contain sm:w-full mx-auto" >
                        </div>
                    </div>
                    <div class="sm:col-span-3 py-2 sm:py-6 text-center sm:text-left">
                        <h1 class="text-white text-2xl sm:text-3xl title-font font-semibold mb-4 sm:mb-8 line-clamp-2">{{$product->title}}</h1>
                        <p class="mb-2 text-xs sm:text-sm"><span class="h-6">{{$product->country->emoji}}</span> {{$product->country->name}}</p>
                        <p class="text-xs sm:text-sm">
                            {{$product->subheading}}
                        </p>
                    </div>
                    <div class="sm:col-span-1 order-first sm:order-last ">
                        <button class="btn btn-ghost btn-sm rounded-full float-right sm:float-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <span class="hidden sm:inline">Add favorite</span>
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
                            <div class="card card-body flex flex-row bg-white p-4 shadow-xl w-full rounded-3xl hover:shadow-lg dark:border-transparent transition-shadow" :class="{'border border-2 border-primary': variation == {{$variation->id}}}">
                                <label class="flex flex-row gap-4 items-center w-full" for="variation-{{$variation->id}}" @click="calculatedAmount">
                                    <img src="{{$product->featured_img_thumb}}" alt="{{$variation->name}}" class="w-14 h-14 rounded-xl">
                                    <div class="flex justify-between gap-2 w-full font-semibold">
                                        <div class="text-xs sm:text-sm">{{$variation->name}}</div>
                                        <div class="text-xs sm:text-sm text-red-600 font-semibold">
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
                    <x-card class="card card-body bg-white shadow-xl w-full">
                        <div class="form-control ">
                            <x-label value=" Purchase Quantity" class="font-semibold mb-2" />
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
                        <div class="divider my-0"></div>
                        <x-button class="btn btn-primary btn-block mx-0" wire:loading.class="loading" wire:target="save" x-bind:disabled="quantity<1" type="submit">Buy Now</x-button>
                    </x-card>
                </aside>
            </div>

        </form>

        <section class="description sm:mt-6 mt-4 bg-gray-100 py-4 sm:py-6">
            <div class="container">
                <div class="flex mb-4 border-b-2 border-gray-300 gap-4 sm:gap-8">
                    <a :class="{ 'active border-b-2 text-primary border-primary': tab === 'description' }" x-on:click.prevent="tab = 'description'" class="flex-groww py-2 text-sm sm:text-lg px-1" href="#">Description</a>
                    <a :class="{ 'active border-b-2 text-primary border-primary': tab === 'redemption-info' }" x-on:click.prevent="tab = 'redemption-info'" class="flex-groww py-2 text-sm sm:text-lg px-1" href="#">Redemption</a>
                </div>

                <div x-show="tab === 'description'">
                    <div class="text-sm">
                        {!! $product->description !!}
                    </div>
                </div>

                <div x-show="tab === 'redemption-info'">
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>
            </div>
        </section>

        @if($related->count())
            <section class="mb-0 mt-4">
                <div class="container">
                    <h2 class="font-semibold mb-4 text-md sm:text-xl">You may also like</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach($related as $rp)
                            <x-product.layout-two :product="$rp" />
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
