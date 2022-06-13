<x-app-layout>

    <section class="animate__animated animate__bounce mt-0 relative mb-4">
        @if(1>2)
        <div id="carouselExampleCrossfade" class="carousel slide carousel-fade relative" data-bs-ride="carousel">
            <div class="carousel-inner relative w-full overflow-hidden">
                @foreach($slides as $slide)
                    <div class="carousel-item @if($loop->first) active @endif float-left w-full">
                        <img
                            src="{{$slide}}"
                            class="block w-full sm:max-h-96 lg:max-h-[35rem] object-fill"
                            alt="Wild Landscape"
                        />
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                @foreach($slides as $slide)
                    <div class="swiper-slide bg-white">
                        <img src="{{ $slide }}" class="rounded-none w-full max-h-full h-44 lg:h-[35rem] object-cover">
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="mb-4">
        <div class="grid grid-cols-1 sm:grid-cols-2">
            <div class="text-white bg-primary py-10 px-5 sm:py-10 sm:px-10 space-y-4 sm:space-y-8 flex flex-col justify-center order-last sm:order-first">
                <h2 class="font-bold text-3xl sm:text-5xl max-w-4xl text-secondary">Who We Are</h2>
                <div class="sm:text-lg">
                    <p>At Amaris.ng, Our major focus is to help bridge the gap in which consumers gain access to products through the use of technology.</p>

                    <p>We believe that technology has come to change the way and manner of which products and services get to their final consumers.</p>

                    <p>Our main goal is to provide an accessible market place with a well-integrated and precise platform where it is easy for every and anyone to be able to access both physical and digital products seamlessly.</p>
                </div>
                <div class="flex flex-wrap sm:flex-nowrap justify-start gap-4 sm:gap-6 w-full max-w-md">
                    <a href="#" title="Start buying" class="btn btn-outline-white">
                        Start Buying
                    </a>
                    <a href="button" title="more about" class="order-first btn btn-light transition">
                        More About
                    </a>
                </div>
            </div>
            <div class="hidden sm:block">
                <img src="{{Storage::url('amaris-3d-mock-up.jpg')}}" alt="About Us" class="h-full object-cover">
            </div>
        </div>
    </section>
    <section class="bg-secondary-200 sm:bg-secondary-100 text-center py-2 mb-2">
        <h2 class="font-medium text-xl sm:text-2xl">Don't Miss Out On These!!!</h2>
    </section>
    <section class="mb-4">
        <a href="{{route('pages.about-us')}}" class="block">
            <img src="{{Storage::url('Inspiring-innovative.jpg')}}" class="w-full object-cover" alt="Inspiring-innovative">
        </a>
    </section>

    <section class="mb-4">

        <a href="{{route('pages.products')}}" class="block">
            <img src="{{Storage::url('Quality-services.jpg')}}" class="w-full object-cover" alt="Quality services">
        </a>
    </section>

    <section class="mb-4">
        <a href="{{route('cards.index')}}" class="block">
            <img src="{{Storage::url('One-Voucher.jpg')}}" class="w-full object-cover" alt="Our Vision">
        </a>
    </section>

    <section class="mb-4">
        <a href="{{route('pages.products')}}" class="block">
            <img src="{{Storage::url('Power-problem.jpg')}}" class="w-full object-cover" alt="Power-problem">
        </a>
    </section>


    @if(1>2)
    <!-- Hero -->
    <section class="relative pb-10 pt-20 md:pt-32 lg:h-[88vh]">
        <div class="container h-full">
            <div class="grid h-full items-center gap-4 md:grid-cols-12">
                <div class="col-span-6 flex h-full flex-col items-center justify-center py-10 md:items-start md:py-20 xl:col-span-4">

                    <h1 class="text-4xl font-bold sm:text-5xl text-primary">Amaris <span class="text-secondary">Synergy</span></h1>
                    <p class="text-lg">Creating an enabling environment that focuses on easing distribution of digital and physical products among users with premium product for fair prices.</p>


                    <div class="flex space-x-4">
                        <a href="create.html"
                            class="bg-accent shadow-accent-volume hover:bg-accent-dark w-36 rounded-full py-3 px-8 text-center font-semibold text-white transition-all">
                            Upload
                        </a>
                        <a href="collections.html"
                            class="text-accent shadow-white-volume hover:bg-accent-dark hover:shadow-accent-volume w-36 rounded-full bg-white py-3 px-8 text-center font-semibold transition-all hover:text-white">
                            Explore
                        </a>
                    </div>
                </div>

                <!-- Hero image -->
                <div class="col-span-6 xl:col-span-8">
                    <div class="relative text-center md:pl-8 md:text-right">
                        <svg
                            viewbox="0 0 200 200"
                            xmlns="http://www.w3.org/2000/svg"
                            class="mt-8 inline-block w-72 rotate-[8deg] sm:w-full lg:w-[24rem] xl:w-[35rem]"
                        >
                            <defs>
                                <clipPath id="clipping" clipPathUnits="userSpaceOnUse">
                                    <path
                                        d="
                    M 0, 100
                    C 0, 17.000000000000004 17.000000000000004, 0 100, 0
                    S 200, 17.000000000000004 200, 100
                        183, 200 100, 200
                        0, 183 0, 100
                "
                                        fill="#9446ED"
                                    ></path>
                                </clipPath>
                            </defs>
                            <g clip-path="url(#clipping)">
                                <!-- Bg image -->
                                <image href="{{ Storage::url('home-img-1.png') }}" width="200" height="200" clip-path="url(#clipping)" />
                            </g>
                        </svg>
                        <img src="{{ Storage::url('3D_elements.png') }}" alt="" class="animate-fly absolute top-0 md:-right-[10%]" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end hero -->

    <section class="pt-10 pb-10 sm:pb-16 dark:bg-gray-900">
        <div class="container">
            <div class="flex gap-2 justify-between items-center border-b my-6">
                <h2 class="font-display font-bold text-jacarta-700 text-center text-xl sm:text-3xl dark:text-gray-200">
                    <span class="mr-1 inline-block h-6 w-6 bg-contain bg-center text-xl" style="background-image: url('https://cdn.jsdelivr.net/npm/emoji-datasource-apple@7.0.2/img/apple/64/1f525.png');"></span> <span class="text-primary dark:text-gray-200">Gift Cards</span>
                </h2>
                <div>
                    <a class="btn btn-sm btn-link" href="{{route('cards.index')}}">Browse All</a>
                </div>
            </div>


            <div class="relative">
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 sm:gap-8">
                    @foreach ($platforms as $platform)
                        <article>
                            <div class="dark:bg-jacarta-700 dark:border-jacarta-700 border-jacarta-100 rounded-3xl block border bg-white p-[1.1875rem] transition-shadow hover:shadow-lg">
                                <figure>
                                    <a href="{{ route('cards.index', ['code'=>$platform->slug]) }}">
                                        <img src="{{$platform->getFirstMediaUrl('featured_image','thumb')}}" alt="{{$platform->name}}" width="230" height="230" class="w-full rounded-[0.625rem]"/>
                                    </a>
                                </figure>
                                <div class="mt-4 flex items-center justify-center">
                                    <h2>
                                        <a href="{{ route('cards.index', ['code'=>$platform->slug]) }}">
                                            <span class="font-display text-jacarta-700 hover:text-accent text-base dark:text-white">{{$platform->name}}</span>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="dark:bg-gray-900 relative pb-10 sm:pb-16">
        <div class="container">
            <div class="flex gap-2 justify-between items-center border-b my-6">
                <h2 class="font-display font-bold text-jacarta-700 text-center text-xl sm:text-3xl dark:text-gray-200">
                    <span class="animate-heartBeat mr-1 inline-block h-6 w-6 bg-contain bg-center text-xl" style="background-image: url(https://cdn.jsdelivr.net/npm/emoji-datasource-apple@7.0.2/img/apple/64/2764-fe0f.png);"></span>
                    Ninja Power System
                </h2>
                <div>
                    <a class="btn btn-sm btn-link" href="{{route('cards.index')}}">Browse All</a>
                </div>
            </div>

            <div class="relative">
                <!-- Slider -->
                <div class="swiper products-slider !py-5">
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($products as $product)
                        <div class="swiper-slide">
                            <article>
                                <div class="dark:bg-jacarta-700 dark:border-jacarta-700 border-jacarta-100 rounded-3xl block border bg-white p-[1.1875rem] transition-shadow hover:shadow-lg h-full">
                                    <figure>
                                        <a href="{{ route('product.show',$product->slug) }}">
                                            <img src="{{$product->getFirstMediaUrl('featured_image','thumb')}}" alt="{{$product->title}}" width="200" height="200" class="w-full rounded-[0.625rem] sm:h-56 object-cover sm:max-h-[15rem]"/>
                                        </a>
                                    </figure>
                                    <div class="mt-4">
                                        <h2>
                                            <a href="{{ route('product.show', $product->slug) }}">
                                                <span class="font-display text-jacarta-700 hover:text-accent text-base dark:text-white line-clamp-2">{{$product->title}}</span>
                                            </a>
                                        </h2>

                                        <div class="flex justify-between mt-2">
                                            <span class="dark:border-jacarta-600 border-jacarta-100 flex items-center whitespace-nowrap rounded-md border py-1 px-2 text-xs sm:text-sm lg:text-sm xl:text-base">
                                                {{app_money_format($product->regular_price)}}
                                            </span>
                                           <span>
                                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary btn-sm">Quick View</a>
                                           </span>
                                        </div>

                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Slider Navigation -->
                <div class="group swiper-button-prev shadow-white-volume absolute top-1/2 -left-4 z-10 -mt-6 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full bg-white p-3 text-base sm:-left-6 swiper-button-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-jacarta-700 group-hover:fill-accent">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M10.828 12l4.95 4.95-1.414 1.414L8 12l6.364-6.364 1.414 1.414z"></path>
                    </svg>
                </div>
                <div class="group swiper-button-next shadow-white-volume absolute top-1/2 -right-4 z-10 -mt-6 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full bg-white p-3 text-base sm:-right-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-jacarta-700 group-hover:fill-accent">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    @endif


    @push('beforeStyles')
        <link rel="stylesheet" href="{{ mix('css/swiper-bundle.min.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ mix('js/swiper-bundle.js')}}"></script>
        <script>
            // (() => {
            //     const initSlider = () => {
                    const homeSwiper = new Swiper('.home-slider', {
                        slidesPerView: 1,
                        loop: true,
                        spaceBetween: 10,
                        speed: 1000,
                        autoplay:{
                            delay: 5000,
                            disableOnInteraction: false
                        },
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true
                        },
                    });

                    const productsSwiper = new Swiper('.products-slider', {
                        slidesPerView: 1,
                        grabCursor: true,
                        // loop: true,
                        spaceBetween: 30,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        breakpoints: {
                            '640': {
                                slidesPerView: 2,
                                spaceBetween: 20,
                            },
                            '768': {
                                slidesPerView: 3,
                                spaceBetween: 40,
                            },
                            '1024': {
                                slidesPerView: 4,
                                spaceBetween: 30,
                            }
                        }
                    });
                // }

            //     initSlider();
            //
            // })();
        </script>
    @endpush
</x-app-layout>
