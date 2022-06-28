<div>
    <div class="card rounded-none py-8">
            <div class="flex justify-center flex-col items-center">
                <h2 class="font-semibold text-sm">Earnings</h2>
                <p class="font-extrabold text-lg sm:text-4xl">{{app_money_format(Auth::user()->balance)}}</p>
                @can('withdraw-commission')
                    <a href="{{route('account.withdraw.index')}}" class="btn btn-primary btn-sm hidden sm:flex mt-2">Withdraw</a>
                @endcan
            </div>
    </div>
    <div class="container flex flex-col justify-center items-center my-6">
        <div class="relative w-full">
            <input type="text" id="affiliateUrl" class="w-full sm:pl-10 sm:pr-60 pl-10 pr-10 h-16 rounded-full text-xl z-0 focus:shadow focus:outline-none border-primary" value="{{Auth::user()->referral_link}}" readonly>
            <div class="absolute top-0 bottom-2 right-1 msy-2 sdm:mt-auto flex flex-col h-full items-center">
                <button data-clipboard-target="#affiliateUrl" class="w-full h-full sm:w-auto my-1 px-12 py-2 text-white bg-primary text-lg hover:bg-primary rounded-full" id="copy">Copy</button>
            </div>
        </div>
        <span id="copyMessage" class="text-center w-full text-success"></span>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('vendor/clipboard.js/dist/clipboard.min.js') }}"></script>
    <script>
        var clipboard = new ClipboardJS('#copy');
        clipboard.on('success', function(e) {
            console.info('Action:', e.action);
            console.info('Text:', e.text);
            console.info('Trigger:', e.trigger);

            e.clearSelection();
            document.getElementById('copyMessage').innerText = 'Copied'
        });
    </script>
@endpush
