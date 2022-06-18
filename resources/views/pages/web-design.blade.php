<x-app-layout>
    <!-- Page title -->
    <x-page-heading title="Web Design Services" subtitle="We are creative web design agency based in Nigeria, passionate in crafting beautiful and original websites for brands of different classes." />


    <section class="text-gray-600 body-font py-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <div class="lg:flex-grow lg:pr-24 md:pr-16 sm:py-10 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center">
                <h2 class="text-3xl sm:text-5xl mb-4 font-bold text-primary">Our creative digital agency designs and develops bespoke websites
                </h2>
                <p class="mb-8 leading-relaxed">We’re an agile and well rounded website design company that loves to work with start-ups and new businesses.We help brands engage their customers in the digital World. We work with all kinds of clients from all over the world to create thoughtful and purposeful Websites.</p>
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

    @livewire('get-in-touch', ['cta'=>'Grow rapidly with our unlimited Web Design & development'])


</x-app-layout>
