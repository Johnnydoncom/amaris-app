<div x-data="handler()">
    <h2 class="text-center font-semibold text-2xl sm:text-3xl py-6 pt-8">Gift Cards</h2>

    <div class="container grid grid-cols-1 lg:grid-cols-4 gap-1 sm:gap-2 lg:gap-4 py-6">
        <div class="sticky top-0 card card-body h-full w-full p-4 sm:p-2 border rounded-3xl py-4">
            <button class="btn btn-primary btn-sm lg:hidden" @click.prevent="openFilter= !openFilter">
                <svg class="w-6 h-6 flex-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                <span class="flex-1">Filter</span>
            </button>
            <form method="get" action="{{route('cards.index')}}" id="filterCards" class="lg:block" :class="{'block mt-4': openFilter, 'hidden': !openFilter}" x-transition>
                <div class="relative w-full max-w-sm">
                    <input type="text" class="w-full py-2 pr-10 pl-4 text-gray-700 bg-white border border-gray-100 rounded-3xl dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-primary dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-primary" name="keyword" value="{{request()->get('keyword')}}" placeholder="Search">
                    <button class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="code" value="{{request()->get('code')}}">
                <div class="mt-4">
                    <ul class="menu space-y-4">
                        @foreach($platforms as $pt)
                            <li class="">
                                <a href="{{ route('cards.index',['code'=>$pt->slug]) }}" class="flex justify-between @if(request()->get('code')==$pt->slug) active text-white @endif">
                                    {{$pt->name}}
                                    <span>{{$pt->products->count()}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </form>
        </div>
        <div class="col-span-3">
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($cards as $card)
                    <x-card.layout-one :product="$card" />
                @endforeach
            </div>
        </div>
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
