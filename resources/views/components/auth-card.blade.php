<div class="min-h-screen flex flex-col items-stretch sm:justify-center items-center pt-6 sm:pt-0 bg-white relative">

{{--    items-center sm:items-start   min-w-full  relative sm:flex-none--}}
    <div class="justify-center sm:justify-start min-w-fulll max-w-max p-0 sm:p-4 flex-none flex-wrap self-start">
{{--        {{ $logo }}--}}
            <span>
                <a href="/" class="block">
                    <x-application-logo class="h-14 sm:h-20 mx-auto sm:mx-0 fill-current text-gray-500" />
                </a>
            </span>

    </div>

    <div class="flex flex-col items-center grow w-full justify-center self-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-mdd overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
