<x-app-layout>
    @if(1>2)
    <!-- Page title -->
    <section class="relative pt-14 lg:pb-16">
        <picture class="pointer-events-none absolute inset-0 -z-10 dark:hidden">
            <img src="{{Storage::url('gradient_light.jpg')}}" alt="gradient" class="h-full w-full" />
        </picture>
        <div class="container">
            <!-- Page Title -->
            <div class="mx-auto max-w-2xl py-16 text-center">
                <h1 class="font-display text-jacarta-700 mb-8 text-4xl font-extrabold dark:text-white">About {{config('app.name')}}</h1>
                <p class="dark:text-jacarta-300 text-lg leading-normal">
                    At Amaris.ng, Our major focus is to help bridge the gap in which consumers gain access to products through the use of technology.
                </p>
            </div>
        </div>
    </section>
        @endif

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
                            <p>
                                With the rapid increasing cost of power supply and the unreliable power system, you would agree that having your own economic power solution Backup is the best you can do for yourself.
                            </p>
                            <p><strong>Introducing The Ninja Power System Backups</strong></p>
                        </div>
                        <div class="order-first sm:order-last">
                            <img src="{{ Storage::url('lithium-ion-batteries-hybrid-power-systems.jpg') }}" class="object-cover rounded-full h-56" alt="Product Image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
        </section>


        <section class="container mb-8">
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 sm:gap-4 px-2">
                @foreach ($products as $product)
                    <article>
                            <div class="dark:bg-jacarta-700 dark:border-jacarta-700 border-jacarta-100 rounded-3xl block border bg-white p-[1.1875rem] transition-shadow hover:shadow-lg h-full">
                                <figure>
                                    <a href="{{ route('product.show',$product->slug) }}">
                                        <img src="{{$product->getFirstMediaUrl('featured_image','thumb')}}" alt="{{$product->title}}" class="w-full rounded-[0.625rem] sm:h-56 object-cover sm:max-h-[15rem]"/>
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
                @endforeach
            </div>
        </section>
</x-app-layout>
