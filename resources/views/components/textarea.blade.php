@props(['disabled' => false])


<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full textarea textarea-bordered rounded-none focus:border-primary focus:inset-primary focus:outline-none focus:ring-primary']) !!}>{{ $slot }}</textarea>
