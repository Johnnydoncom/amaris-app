@props(['product'])
<div class="w-full overflow-hidden p-2 relative">
    <div class="flex flex-col">
        <a href="{{ route('product.show', $product->slug) }}" class="flex flex-col h-full justify-center relative scale-95 hover:scale-100 transition duration-500">
            @if($product->country)
                <div class="absolute right-2 top-0">
                    <span class="text-2xl rounded-2xl">{!!$product->country->emoji!!}</span>
                </div>
            @endif
            <img class="rounded-lg w-full" src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" />
        </a>

        <div class="text-center py-2">
            <h3 class="font-semibold text-xs my-0 line-clamp-2 " title="{{$product->title}}"><a href="{{ route('product.show', $product->slug) }}" class="">{{$product->title}}</a></h3>
        </div>
    </div>
</div>

