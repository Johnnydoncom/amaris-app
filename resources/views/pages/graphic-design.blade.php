<x-app-layout>
    <!-- Page title -->

    <section class="relative">

        <div class="relative bg-primary text-white bg-cover bg-clip-padding w-full pb-5 sm:pb-0 after:absolute after:inset-0 bg-page-heading-pattern">
            <div class="container py-6 relative z-10">
                <div class="py-16 text-left max-w-4xl">
                    <h1 class="text-white mb-8 text-3xl sm:text-5xl lg:text-6xl font-extrabold dark:text-white">Graphic Design Services</h1>
                    <p class="dark:text-jacarta-300 text-lg leading-normal">Get the right branding for your business
                    </p>
                </div>
            </div>
        </div>
    </section>



    <section class="text-gray-600 body-font py-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <h2 class="text-3xl sm:text-5xl mb-4 font-bold text-primary">We create Design That Speaks to Your Brand.
                </h2>
                <p class="mb-2 leading-relaxed">From conception to completion, a world-class graphic design agency
                    Amaris.ng provides a one-of-a-kind, creative, and professional graphic design for your company or event. We design eye-catching graphics such as flyers, brochures, logos, business cards, and illustrations, among other things.</p>

                <p class="mb-2 leading-relaxed">We understand that you need your graphic to attract more people, generate sales, differentiate your brand, and so on, and we can help you with that.</p>

                <p class="mb-2 leading-relaxed">We pledge to exceed your expectations by providing high-quality graphic design services at an incomparable price, collaborating with you from beginning to end, and providing a money-back guarantee if you are not happy.</p>

        </div>
    </section>




    @livewire('get-in-touch', ['cta'=>'Get in touch with us to discuss your project'])

</x-app-layout>
