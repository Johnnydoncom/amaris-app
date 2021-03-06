@props(['product'])

<article>
    <div class="dark:bg-jacarta-700 dark:border-jacarta-700 border-jacarta-100 rounded-3xl block border bg-white p-[1.1875rem] transition-shadow hover:shadow-lg h-full">
        <figure class="relative">
            <a href="{{ route('cards.show', $product->slug) }}">
                <img src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" width="230" height="230" class="w-full rounded-[0.625rem]"/>

                    <img src="{{Storage::url('gift-pin.png')}}" class="h-3 top-2 absolute inset-x-0 mx-auto">

                @if($product->country)
                    <div class="absolute right-2 top-2">
                        <span class="dark:border-jacarta-600 flex items-center whitespace-nowrap rounded-full overflow-hidden py-0 px-0">
{{--                            <span class="text-2xl leading-none">{!!$product->country->emoji!!}</span>--}}
                            <img src="{{ asset('vendor/blade-coreui-icons/cif-'.Str::lower($product->country->iso2).'.svg') }}" class="h-4 w-5"/>
                        </span>
                    </div>
                @endif
            </a>

        </figure>
        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('cards.show', $product->slug) }}">
                <span class="font-semibold text-jacarta-700 hover:text-accent text-sm dark:text-white line-clamp-2">{{$product->title}}</span>
            </a>
        </div>
    </div>
</article>
