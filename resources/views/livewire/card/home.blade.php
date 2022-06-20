<div x-data="handler()">
{{--    <h2 class="text-center font-semibold text-2xl sm:text-3xl py-6 pt-8">Gift Cards</h2>--}}
    <x-page-heading title="Gift Cards" align="center" />


    <div class="container py-6">
        <div class="border-b pt-4 pb-2 flex">
            <form method="get" action="{{route('cards.index')}}" id="filterCards" class="flex gap-2 sm:gap-6 justify-end w-full" x-transition>
{{--                <h3 class="hidden lg:block self-end font-semibold text-xl">Filter</h3>--}}
                <x-floating-select name="code" wrapperClass="w-full max-w-xs">
                    <option value="">All</option>
                    @foreach($platforms as $pt)
                        <option value="{{$pt->slug}}">
                            {{$pt->name}}<span> - ({{$pt->products->count()}})</span>
                        </option>
                    @endforeach
                </x-floating-select>

                <x-floating-input type="text" label="Keyword" id="keyword" wrapperClass="w-full max-w-xs" name="keyword" value="{{request()->get('keyword')}}" placeholder="Keyword" />

                <x-button class="btn btn-primary">
                    Filter
                </x-button>
            </form>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 2xl:grid-cols-6 gap-4 w-full my-6">
            @foreach($cards as $card)
                <x-card.layout-one :product="$card" />
            @endforeach
        </div>

        @if($cards->total() > $perPage)
            <div class="border-b p-2 mt-4">{{$cards->links()}}</div>
        @endif
    </div>

    <script>
        function handler() {
            return {
                platform: '',
                openFilter:false,
                async submitFilter(){
                    document.getElementById("filterCards").submit()
                    // alert(3)
                },
                async setPlatform(d){
                    this.platform = d;
                    this.submitFilter()
                }
            }
        }
    </script>
</div>
