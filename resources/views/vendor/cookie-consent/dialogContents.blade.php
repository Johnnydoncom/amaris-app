<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 pb-2 z-40">
    <div class="max-w-md ml-auto px-6">
        <div class="p-2 rounded-lg bg-secondary-100">
            <div class="flex flex-col flex-wrap">
                <div class="flex-1 items-center hidden md:inline">
                    <p class="ml-3 text-black cookie-consent__message">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
                <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                    <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>