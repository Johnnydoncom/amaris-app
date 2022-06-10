@props(['product'])

<div class="w-full rounded-lg shadow-lg bg-white overflow-hidden hover:scale-105 transition duration-500 relative p-2 sm:p-4">

    <div class="bg-contain w-10 mx-auto h-4" style="background-image: url({{Storage::url('gift-pin.png')}})"></div>
{{--    <h3 class="text-center font-bold text-xs sm:text-sm mt-4 mb-4 text-primary line-clamp-1">{{$product->title}}</h3>--}}
    <div class="flex flex-col mt-4">
        <a href="{{ route('product.show', $product->slug) }}" class="flex flex-col h-full justify-center relative ">
            <img class="rounded-lg w-full" src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" />
            <span class="bg-primary text-white mx-auto py-1 px-2 sm:px-4 rounded-full -mt-3 sm:-mt-3 justify-center text-xs">
{{--                {{ app_money_format($product->min_price) }}--}} Gift Card
            </span>
        </a>

        <div class="px-2 sm:px-4 py-3 text-center">
{{--            <h3 class="text-gray-700 text-xs sm:text-sm font-normal line-clamp-2">{{$product->subheading}}</h3>--}}
            <h3 class="text-center font-semibold text-xs sm:text-sm my-0  line-clamp-1" title="{{$product->title}}"><a href="{{ route('product.show', $product->slug) }}" class="">{{$product->title}}</a></h3>
        </div>
    </div>




{{--    <div class="flex items-end justify-end h-40 w-full bg-cover" style="background-image: url('{{$product->featured_img_thumb}}')">--}}

{{--        <button class="btn btn-primary btn-circle rounded-full mx-5 -mb-4">--}}
{{--            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>--}}
{{--        </button>--}}
{{--    </div>--}}

</div>


@if(1>2)
<div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:scale-105 transition duration-500 relative dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('product.show', $product->slug) }}">
        <img class="rounded-t-lg" src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" />
    </a>
    <div class="p-5">
        <a href="{{ route('product.show', $product->slug) }}">
            <h2 class="mb-2 text-lg sm:text-xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2">{{$product->title}}</h2>
        </a>
{{--        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>--}}
    </div>
</div>
@endif
@if(1>2)
<div class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 relative bg-white h-full">
        <div>
            <img src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" class="w-full"/>
        </div>
        <div class="py-4 px-2 bg-white h-full min-h-full">
            <h3 class="text-xs lg:text-sm font-normal text-gray-600 relative line-clamp-2">
                <a href="{{ route('product.show', $product->slug) }}">
                        {{$product->title}}
                </a>
            </h3>

            <div class="mt-2 font-thin flex items-center space-x-2">
                @if($product->sales_price > 0)
                <p class="text-xs font-medium text-gray-900">{{ $product->formatted_sales_price }}</p>
                @endif

                <p class="@if($product->sales_price > 0) text-gray-500 text-xs line-through @else text-gray-900 text-xs font-semibold @endif">
                    {{ $product->formatted_regular_price }}
                </p>
            </div>
        </div>
    </div>
@endif
