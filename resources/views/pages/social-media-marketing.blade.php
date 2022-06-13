<x-app-layout>
    <!-- Page title -->

    <section class="relative">

        <div class="relative bg-primary text-white bg-cover bg-clip-padding w-full pb-5 sm:pb-0 after:absolute after:inset-0 bg-page-heading-pattern">
            <div class="container py-6 relative z-10">
                <div class="py-16 text-left max-w-4xl">
                    <h1 class="text-white mb-8 text-3xl sm:text-5xl lg:text-6xl font-extrabold dark:text-white">Social Media Marketing</h1>
                    <p class="dark:text-jacarta-300 text-lg leading-normal">Get the right branding for your business
                    </p>
                </div>
            </div>
        </div>
    </section>


    @if(1>2)
    <section class="text-gray-600 body-font py-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <div class="lg:flex-grow lg:pr-24 md:pr-16 sm:py-10 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center">
                <h2 class="text-3xl sm:text-5xl mb-4 font-bold text-primary">We create Design That Speaks to Your Brand.
                </h2>
                <p class="mb-2 leading-relaxed">At our Graphic Design Agency, take pride in creating content that not only stands out in a feed but is also proven to drive results. As a team of award-winning designers, developers, and content strategists, we are always pushing to set this year’s trends in graphic design.</p>

                <p class="mb-2 leading-relaxed">From websites to paid ads, from print to digital, our team creates assets across platforms and mediums in order to build awareness and grow your business. Our graphic design agency capabilities also include brand identity, including logos, packaging, and more.</p>
                <div class="flex justify-start w-full lg:w-auto">
                    <a href="{{route('pages.contact')}}" class="btn btn-primary btn-lg">
                        Start your project
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 order-first lg:order-last">
                <img class="object-cover object-center rounded" alt="hero" src="{{ Storage::url('web-design-company-nigeria.png') }}">
            </div>
        </div>
    </section>





    <div class="bg-white py-6 sm:py-10 lg:py-12">
        <div class="container">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="text-primary text-2xl sm:text-5xl font-bold text-center mb-4 md:mb-2">What can we do for your business?</h2>

                <p class="max-w-screen-md text-gray-500 md:text-lg text-center mx-auto">To give you an idea on the types of services we offer here's a few we specialise in...</p>
            </div>
            <!-- text - end -->

            <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6 xl:gap-8">
                <!-- feature - start -->
                <div class="flex flex-col items-center transition-shadow hover:shadow-lg p-4">
                    <div class="w-12 md:w-14 h-12 md:h-14 flex justify-center items-center text-secondary mb-2 sm:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>

                    <h3 class="text-lg md:text-xl font-semibold text-center mb-2">Web Development</h3>
                    <p class="text-gray-500 text-center mb-2">We have the skills to build our own websites and everything we do is produced at eSterling HQ. We choose the right technology to meet your requirements – whether it’s WordPress, OpenCart, Magento or a completely bespoke requirement.</p>
                </div>
                <!-- feature - end -->

                <!-- feature - start -->
                <div class="flex flex-col items-center transition-shadow hover:shadow-lg p-4">
                    <div class="w-12 md:w-14 h-12 md:h-14 flex justify-center items-center text-secondary mb-2 sm:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>

                    <h3 class="text-lg md:text-xl font-semibold text-center mb-2">Branding & Graphic Design</h3>
                    <p class="text-gray-500 text-center mb-2">Our team of skilled Graphic designers are specialists in corporate identity and brand awareness. A company’s brand is an often undervalued part of any business and we make sure you’re one-step ahead of your competition.</p>
                </div>
                <!-- feature - end -->

                <!-- feature - start -->
                <div class="flex flex-col items-center transition-shadow hover:shadow-lg p-4">
                    <div class="w-12 md:w-14 h-12 md:h-14 flex justify-center items-center text-secondary mb-2 sm:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>

                    <h3 class="text-lg md:text-xl font-semibold text-center mb-2">eCommerce Solutions</h3>
                    <p class="text-gray-500 text-center mb-2">We provide the complete package from a beautiful web design, hosting and payment provider integration through to PCI compliance. We’ll help with getting all your product information into the website and if required provide full customisation and integration with internal business systems and accounts software.</p>
                </div>
                <!-- feature - end -->

                <!-- feature - start -->
                <div class="flex flex-col items-center transition-shadow hover:shadow-lg p-4">
                    <div class="w-12 md:w-14 h-12 md:h-14 flex justify-center items-center text-secondary mb-2 sm:mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>

                    <h3 class="text-lg md:text-xl font-semibold text-center mb-2">Digital Marketing Campaigns</h3>
                    <p class="text-gray-500 text-center mb-2">Our design team work closely with our SEO department to tailor your requirements to produce a professional marketing presence. The closeness of the two departments allows for a shared, linear target which benefits our clients greatly.</p>
                </div>
                <!-- feature - end -->
            </div>
        </div>
    </div>


    <div class="relative flex flex-col justify-center w-full bg-secondary">
        <div class="container p-4 sm:p-20 py-6 sm:py-12 text-center">
            <h2 class="text-3xl sm:text-5xl font-bold leading-tight text-white">Grow rapidly with our unlimited Web Design & development</h2>
            <p class="mt-5 text-sm sm:text-xl leading-8 text-white">
                Get in touch with us to discuss your project
            </p>
            <div class="mt-6 flex items-center justify-center gap-4">
                <a href="{{route('pages.contact')}}" class="flex items-center justify-center gap-2 rounded-full border border-white/50 px-5 py-3 text-lg font-medium text-white">
                    <span> Contact Us</span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M6.00156 13.4016L4.60156 12.0016L8.60156 8.00156L4.60156 4.00156L6.00156 2.60156L11.4016 8.00156L6.00156 13.4016Z" fill="white" /></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>

@endif
</x-app-layout>
