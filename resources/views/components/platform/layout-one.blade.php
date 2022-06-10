@props(['platform'])

<div class="w-full rounded-2xl relative hover:bg-white">

{{--    <div class="bg-contain w-10 mx-auto h-4" style="background-image: url({{Storage::url('gift-pin.png')}})"></div>--}}

    <div class="flex flex-col">
        <a href="{{ route('cards.index', ['code'=>$platform->slug]) }}" class="flex flex-col h-full justify-center relative scale-95 hover:scale-100 transition duration-500">
            <img class="rounded-lg w-full" src="{{$platform->getFirstMediaUrl('featured_image')}}" alt="{{$platform->name}}" />
        </a>

        <div class="px-2 sm:px-4 py-3 text-center">
            {{--            <h3 class="text-gray-700 text-xs sm:text-sm font-normal line-clamp-2">{{$product->subheading}}</h3>--}}
            <h3 class="text-center font-semibold text-xs sm:text-sm my-0  line-clamp-1" title="{{$platform->name}}"><a href="{{ route('cards.index', ['code'=>$platform->slug]) }}" class="">{{$platform->name}}</a></h3>
        </div>
    </div>

</div>

