@props(['title','subtitle'=>'','align'=>'left'])

<section class="relative">

    <div class="relative bg-primary text-white bg-cover bg-clip-padding w-full sm:pb-0 after:absolute after:inset-0 bg-page-heading-pattern">
        <div class="container relative z-10 py-6">
            <div class="py-10 sm:py-16 text-{{$align}} max-w-4xl @if($align=='center') mx-auto @endif">
                <h1 class="text-white @if($subtitle) mb-2 @endif text-3xl sm:text-5xl lg:text-6xl font-extrabold dark:text-white">{{ $title }}</h1>
                @if($subtitle)
                <p class="dark:text-jacarta-300 text-lg leading-normal">{{ $subtitle }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
