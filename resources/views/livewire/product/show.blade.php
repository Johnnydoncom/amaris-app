<div>
    {{--    <x-slot name="title">{{$product->title}}</x-slot>--}}
    <div class="py-1 relative mx-0 product bg-white" id="single-product" x-data="order()">
        <form method="post" wire:submit.prevent="save()">
            @csrf
            <div class="lg:p-4 container z-0 relative product-summary px-0 pl-0 bg-white" style="">
                <div class="grid grid-cols-1 lg:grid-cols-4 sm:gap-8 gap-8 mb-4">
                    <div class="lg:col-span-2 " wire:ignore>
                        <div class="swiper gallery-slider">
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach($gallery as $key => $slide)
                                    <div class="swiper-slide bg-white">
                                        <img src="{{ $slide }}" class="rounded w-full">
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 sm:border-4 sm:border-secondary">
                        <div class="w-full lg:p-10 lg:py-6 mb-6 lg:mb-0 max-h-full lg:pr-24">
                            <h2 class="text-xs sm:text-sm title-font text-gray-500 tracking-widest uppercase mb-2">{{ $product->category->name }}</h2>
                            <h1 class="text-gray-900 text-xl sm:text-3xl title-font font-semibold mb-0">{{$product->title}}</h1>

                            <div class="price my-4">
                                <div class="mt-2 flex items-end space-x-2">
                                    <div class="font-medium block">
                                        <span class="text-red-600 font-bold text-2xl">{{ $product->sales_price > 0 ? app_money_format($product->sales_price) : app_money_format($product->regular_price) }} </span>
                                    </div>
                                    <span class="text-success text-sm">Price excl. VAT</span>
                                </div>
                            </div>

                            <div class="my-4 flex gap-8">
                                <div class="w-full sm:w-1/2">
                                    <x-floating-input label="Quantity" @click="if(quantity<1){quantity=1;}" id="quantity" type="number" x-model="quantity" wire:model.defer="quantity" min="1" wrapperClass="w-full" placeholder="" />
                                </div>
                            </div>
                            <div class="cart-btn mt-8 w-full sm:w-1/2">
                                <button class="btn btn-primary btn-block bg-black" wire:loading.class="loading">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <section class="description py-2 pb-10">
            <div class="container">
                <div class="flex border-b-2 border-gray-300 gap-4 sm:gap-8">
                    <a :class="{ 'active border-b-2 text-primary border-primary': tab === 'description' }" x-on:click.prevent="tab = 'description'" class="flex-groww py-2 text-sm sm:text-lg px-1 uppercase" href="#">Description</a>
                </div>

                <div x-show="tab === 'description'">
                        {!! $product->description !!}
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
                    quantity: 1,
                    amount: @entangle('amount'),
                    swiper: null,
                    tab: 'description'
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
