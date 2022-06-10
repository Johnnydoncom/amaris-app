<div>

    <!-- component -->
    <div class="bg-white">
        <div  class="container m-auto px-6 space-y-8 text-gray-500 md:px-12 lg:px-12">
            <div class="justify-center text-left sm:text-center gap-6 sm:text-left sm:flex sm:items-center sm:gap-16 pt-6 sm:pt-2 px-2 sm:px-0">
                <div class="order-first mb-6 space-y-6 sm:mb-0 sm:w-6/12 lg:w-6/12">
                    <h1 class="text-4xl text-gray-700 font-bold sm:text-5xl">Buy customized gift cards online - <span class="text-primary">Fast, Customized, Earn Cash Back</span></h1>
                    <p class="text-lg">Be part of millions people around the world sending gifts to their loved ones.</p>
                    <div class="flex flex-row-reverse flex-wrap justify-center gap-4 sm:gap-6 sm:justify-end hidden sm:flex">
                        <button type="button" title="Start buying" class="w-full py-3 px-6 text-center rounded-xl transition bg-gray-700 shadow-xl hover:bg-gray-600 active:bg-gray-700 focus:bg-gray-600 sm:w-max">
                        <span class="block text-white font-semibold">
                            Start buying
                        </span>
                        </button>
                        <button type="button" title="more about" class="w-full order-first py-3 px-6 text-center rounded-xl bg-gray-100 transition hover:bg-gray-200 active:bg-gray-300 focus:bg-gray-200 sm:w-max">
                        <span class="block text-gray-600 font-semibold">
                            More about
                        </span>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-5 grid-rows-4 gap-4 sm:w-5/12 lg:w-6/12 hidden sm:flex">
                    <div class="col-span-2 row-span-4">
                        <img src="https://tailus.io/sources/blocks/ecommerce-site/preview/images/products/kushagra.webp" class="rounded-full" width="640" height="960" alt="shoes" loading="lazy">
                    </div>
                    <div class="col-span-2 row-span-2">
                        <img src="https://tailus.io/sources/blocks/ecommerce-site/preview/images/products/iman.webp" class="w-full h-full object-cover object-top rounded-xl" width="640" height="640" alt="shoe" loading="lazy">
                    </div>
                    <div class="col-span-3 row-span-3">
                        <img src="https://tailus.io/sources/blocks/ecommerce-site/preview/images/products/daniel.webp" class="w-full h-full object-cover object-top rounded-xl" width="640" height="427" alt="shoes" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="card glass">
            <div class="card-body p-4 sm:p-8 bg-secondary">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="form-control">
                        <x-label class="text-gray-200 mb-2">Select Category</x-label>
                        <x-select class="w-full" wire:model="country">
                            <option value="">All</option>
                            @foreach($countries as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <div class="form-control">
                        <x-label class="text-gray-200 mb-2">Sort By</x-label>
                        <x-select class="w-full" wire:model="sort">
                            <option value="asc">A to Z</option>
                            <option value="desc">Z to A</option>
                            <option value="popular">Most Viewed</option>
                            <option value="new">Newest</option>
                        </x-select>
                    </div>

                   <div>
                       <x-label class="text-gray-200 mb-2">Search</x-label>
                       <div class="relative">
                           <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                               <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                           </div>
                           <x-input type="search" id="default-search" wire:model.lazy="search" class="pl-10 w-full text-sm text-gray-900" placeholder="Search Gift Cards" />
                       </div>
                   </div>


                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="card glass">
            <div class="card-body p-4 sm:p-8 relative">
                @if($products->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-6">
                    @foreach ($products as $product)
                        <x-product.layout-two :product="$product">
                            {{--                    @livewire('product.product-layout-one', ['product'=>$product])--}}
                        </x-product.layout-two>
                    @endforeach
                </div>

                <div class="py-4" wire:loading.remove>
                    {{ $products->links() }}
                </div>
                @else
                <h4>No card found</h4>
                @endif

                <div wire:loading.delay class="z-50 static flex absolute left-0 items-center justify-center top-0 bottom-0 w-full h-full bg-gray-400 bg-opacity-50">
                    <img src="https://paladins-draft.com/img/circle_loading.gif" width="64" height="64" class="mx-auto my-auto">
                </div>
            </div>
        </div>
    </div>
</div>
