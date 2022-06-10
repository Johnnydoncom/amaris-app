@props(['type' => 'light'])
<img src="{{ $type=='dark' ? site_logo_white() : site_logo() }}" {{ $attributes->merge(['class' => 'block dark:hidden']) }}>

<img src="{{ site_logo_white() }}" alt="" {{ $attributes->merge(['class' => 'hidden dark:block']) }}>
