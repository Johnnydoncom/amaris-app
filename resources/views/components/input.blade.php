@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'input input-bordered rounded-lg w-full focus:inset-none focus:ring-0 focus:outset-none']) !!}>
