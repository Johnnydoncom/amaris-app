<x-app-layout>
    <!-- Page title -->
    <x-page-heading title="Social Media Marketing" subtitle="Our objective as a social media marketing company is to help you understand and utilize popular social media so that your business profits from it!" />

    <section class="text-gray-600 body-font py-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-8">
            <div class="lg:flex-grow sm:py-10 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center">
                <h2 class="text-3xl sm:text-5xl mb-4 font-bold text-primary">We Help You Accelerate Growth through Social Media</h2>
                <p class="mb-2 leading-relaxed">The craft of social media marketing has evolved. The perfect social media management company can help you increase sales, expand your audience, and gain insight into how people view you and your products. It's simply too important to overlook as part of your digital marketing plan.</p>

                <p class="mb-2 leading-relaxed">As a social media marketing agency, we don't believe in delivering reams of BAU material or focusing on creating engagements that look nice on paper but don't bring anything to your bottom line. We create social media strategies that support your entire marketing objectives, concentrating on the advantages of social media for your company.
                </p>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 order-first lg:order-last">
                <img class="object-cover object-center rounded" alt="hero" src="{{ Storage::url('social-media-marketing.jpg') }}">
            </div>
        </div>
    </section>


    @livewire('get-in-touch', ['cta'=>'Want to learn more about our social media marketing services? '])

</x-app-layout>
