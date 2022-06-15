<x-app-layout>
    <!-- Page title -->
    <x-page-heading title="Content Creation Services" subtitle="We create content strategy and creatives that converts." />

    <section class="text-gray-600 body-font py-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <div class="lg:flex-grow sm:py-10 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center">
                <h2 class="text-3xl sm:text-5xl mb-4 font-bold text-primary">We create Content That Speaks to Your Brand.
                </h2>
                <p class="mb-2 leading-relaxed">Consumers, media, influencers, stakeholders, and employees, we believe, are demanding more from brands than ever before.</p>

                <p class="mb-2 leading-relaxed"> To thrive, companies must communicate not only who they are, but also what they stand for, to the people who matter.
                </p>

                <p class="mb-2 leading-relaxed"><span class="font-semibold">How are we going to accomplish this?</span> By launching movements that produce tangible outcomes and long-term change.
                </p>

                <p class="mb-2 leading-relaxed">
                    We're masters at developing unique content that gets to the essence of your brand or product, resulting in increased engagement and brand affinity over time.</p>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 order-first lg:order-last">
                <img class="object-cover object-center rounded" alt="hero" src="{{ Storage::url('content-creation.jpg') }}">
            </div>
        </div>
    </section>




    @if(1>2)
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
    @endif

    @livewire('get-in-touch', ['cta'=>'Ready to Start Creating?'])

</x-app-layout>
