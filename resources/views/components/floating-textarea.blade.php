@props(['label' => '', 'wrapperClass'=>'', 'id'=>'floating_outlined'])
<div class="relative {{$wrapperClass}}">
    <textarea id="{{$id}}" {!! $attributes->merge(['class' => 'block p-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer']) !!} placeholder=" ">{{ $slot }}</textarea>
    <label for="{{$id}}" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-primary-600 peer-focus:dark:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">{{$label}}</label>
</div>
