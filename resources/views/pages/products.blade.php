<x-app-layout>
        <x-page-heading title="Products & Services" />

        <section class="container">
            <div class="bg-white py-12 pb-2">
                <div class="m-auto px-2 space-y-8">
                    <div class="justify-center gap-6 sm:text-left grid grid-cols-1 sm:grid-cols-2 items-center sm:gap-16">
                        <div class="order-last sm:order-first mb-6 space-y-4 sm:mb-0">
                            <h1 class="text-3xl font-bold sm:text-5xl text-primary">Ninja Power system</h1>
                            <p class="text-lg">Brand new ninja power system backup will solve all your erratic power problem and finally bid goodbye to all the embarrassment you get from power distribution companies
                            </p>
                            <p>
                                Now you don't need to break the bank to own your own in-house power system backup
                            </p>
                            <p>
                                Worry no more, because the much sought after power solutions are finally here!
                            </p>
                            <a class="btn btn-primary" href="{{route('pages.ninja-power-system')}}">Browse Products</a>
                        </div>
                        <div class="order-first sm:order-last">
                            <img src="{{ Storage::url('lithium-ion-batteries-hybrid-power-systems.jpg') }}" class="object-cover rounded-full max-h-96 h-full mx-auto" alt="Product Image">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
        <div class="bg-white py-12 pb-2">
            <div class="m-auto px-2 space-y-8">
                <div class="justify-center gap-6 sm:text-left grid grid-cols-1 sm:grid-cols-2 items-center sm:gap-16">
                    <div class="text-center">
                        <img src="{{ Storage::url('buy-giftcards.jpg') }}" class="object-cover rounded-full max-h-96 h-full mx-auto" alt="Product Image">
                    </div>
                    <div class="mb-6 space-y-4 sm:mb-0">
                        <h1 class="text-3xl font-bold sm:text-5xl text-primary">Gift Cards</h1>
                        <p class="text-lg">Buy, Send & Claim Gift Cards. Chip in with Friends. Store & Manage Gift Cards.
                        </p>
                        <a class="btn btn-primary" href="{{route('cards.index')}}">Browse Gift Cards</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
