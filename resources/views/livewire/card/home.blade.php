<div x-data="handler()">
    <h2 class="text-center font-semibold text-2xl sm:text-3xl pb-4 pt-8">Gift Cards</h2>

    <div class="container grid grid-cols-4 gap-4 py-6">
        <x-card class="sticky top-11 h-full p-2 border rounded-4xl">
            <form method="get" action="{{route('cards.index')}}" id="filterCards">
                <div class="relative w-full max-w-sm">
                    <input type="text" class="w-full py-2 pr-10 pl-4 text-gray-700 bg-white border border-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-primary dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-primary" name="keyword" value="{{request()->get('keyword')}}" placeholder="Search">
                    <button class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
                <input type="hidden" name="code" value="{{request()->get('code')}}">
                <div class="mt-4">
                    <ul class="space-y-2">
                        @foreach($platforms as $pt)
                        <li>
                            <a href="{{ route('cards.index',['code'=>$pt->slug]) }}" class="flex items-center p-2 text-base font-normal rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 justify-between @if(request()->get('code')==$pt->slug) active text-white bg-secondary @endif">
                                {{$pt->name}}
                                <span>{{$pt->products->count()}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </form>
        </x-card>
        <div class="col-span-3">
            <div class="grid grid-cols-5 gap-4">
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
