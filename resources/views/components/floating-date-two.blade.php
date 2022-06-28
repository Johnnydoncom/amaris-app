@props(['label' => '', 'wrapperClass'=>'', 'error' => null])


<div x-data="{ value: '', d:new Date() }" x-on:change="value = $event.target.value" x-init="new Pikaday({ field: $refs.input, 'format': 'DD.MM.YYYY', firstDay: 1, yearRange:[1900, {{date('Y')}}], maxDate:new Date() });" class="relative {{$wrapperClass}}">
    <input x-ref="input" x-bind:value="value" type="text" {!! $attributes->merge(['class' => 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary focus:outline-none focus:ring-0 focus:border-primary-600 peer']) !!} id="floatingInput" readonly="readonly">
    <label for="{{ $attributes->get('id')}}" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-primary-600 peer-focus:dark:text-primary-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">{{$label}}</label>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
