@props(['product'])

<article>
    <div class="dark:bg-jacarta-700 dark:border-jacarta-700 border-jacarta-100 rounded-3xl block border bg-white p-[1.1875rem] transition-shadow hover:shadow-lg h-full">
        <figure class="relative">
            <a href="{{ route('product.show', $product->slug) }}">
                <img src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" width="230" height="230" class="w-full rounded-[0.625rem]"/>
            </a>

        </figure>
        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('product.show', $product->slug) }}">
                <span class="font-semibold text-jacarta-700 hover:text-accent text-sm dark:text-white line-clamp-2">{{$product->title}}</span>
            </a>
        </div>
    </div>
</article>
