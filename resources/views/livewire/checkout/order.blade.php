<div>
    <div
        class="container"
        x-data="order()"
    >
        <h2 class="text-center font-semibold text-2xl sm:text-3xl py-6">Personalize Gift Card</h2>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-4">
            <div class="col-span-3">
                <div class="card bg-white">
                    <div class="card-body">
                        <form method="post" wire:submit.prevent="save()">
                            @csrf
                            <h3 class="font-semibold mb-2">
                                Choose Card Value
                            </h3>
                            <div class="flex gap-1 items-center flex-wrap sm:flex-nowrap">
                                <x-floating-select id="amount" label="Card Value" name="amount" wrapperClass=" w-full"  wire:model.defer="amount" x-model="amount" autofocus>
                                    <option value="">Select Amount</option>
                                    @foreach($popularAmounts as $pamount)
                                        <option value="{{currency($pamount,null,null,false)}}">{{currency($pamount)}}</option>
                                    @endforeach
                                </x-floating-select>

                                <div class="divider divider-horizontal sm:divider-vertical mx-0">OR</div>

                                <div class="form-control w-full">
{{--                                    <x-label value="Custom Amount" wire:model="amount" />--}}
                                    <div class="flex flex-wrap items-stretch w-full relative">
                                        <x-floating-input label="Custom Amount" type="number" x-model="amount" wire:model.defer="amount" class="flex-1 border-r-0 focus:border-r-0 focus:ring-r-0 rounded-r-none relative outline-none appearance-none" placeholder="0.00" />
                                        <div class="flex -ml-px">
                                            <span class="flex items-center leading-normal bg-grey-lighter  rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-dark text-sm">{{ currency()->getUserCurrency() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('amount')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror

                            <h3 class="font-semibold mt-14 mb-2">
                                Add a Design
                            </h3>
                            <div class="flex items-center gap-4">
                                <div class="form-control w-full sm:w-1/2">
                                    <x-floating-select id="amount" label="Select category" name="design_category" wrapperClass=" w-full"  wire:model="design_category" x-model="design_category">
                                        <option value="">Show All</option>
                                        @foreach($designCategories as $dcat)
                                            <option value="{{$dcat->id}}">{{$dcat->name}}</option>
                                        @endforeach
                                    </x-floating-select>
                                </div>
                                <div class="w-full sm:w-1/2" wire:loading.delay wire:target="design_category">Please wait...</div>
                            </div>


                            <div class="designs grid grid-cols-5 gap-2 mt-4" wire:loading.remove wire:target="design_category">
                                @foreach($messageDesigns as $design)
                                    <label for="design{{$design->id}}" @mouseover="selected_design_bg = '{{$design->getFirstMediaUrl('featured_image')}}'" class="card card-body p-1 bg-white border hover:border-primary shadow" :class="{'border-primary': selected_design=={{$design->id}}}">
                                        <img class="object-cover rounded-xl" src="{{$design->getFirstMediaUrl('featured_image', 'thumb')}}" alt="{{$design->title}}">
                                        <input id="design{{$design->id}}" type="radio" class="hidden" value="{{$design->id}}" x-model="selected_design">
                                        <h5 class="text-xs line-clamp-2">{{$design->title}}</h5>
                                    </label>
                                @endforeach
                            </div>
                            @error('selected_design')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror


                            <div class="w-full sm:w-1/2 mt-14 mb-2">
                                <x-label class="">Add your personal message</x-label>
                                <x-textarea wire:model.defer="personal_message" x-model="personal_message" x-ref="personal_message" x-bind:maxlength="personal_message_limit" row="10" />
                                <p x-ref="remaining" class="text-xs">
                                    You have <span x-text="personal_message_limit - personal_message.length">250</span> characters remaining.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h3 class="font-semibold mt-14 mb-2">How would you like to deliver this Gift Card?</h3>
                                <div class="flex">
                                    <a x-transition :class="{ 'active font-semibold border-t border-l border-r border-b-0': tab === 'email' }" x-on:click.prevent="tab = 'email'" class="flex justify-center flex-grow gap-2 items-center py-2 text-lg px-1 border-b" href="#">
                                        <img src="{{Storage::url('emailandsms.png')}}" class="h-10"> Email/SMS
                                    </a>
                                    <a x-transition :class="{ 'active font-semibold border-t border-l border-r border-b-0': tab === 'delivery' }" x-on:click.prevent="tab = 'delivery'" class="flex justify-center flex-grow gap-2 items-center py-2 text-lg px-1 border-b" href="#">
                                        <img src="{{Storage::url('transport.png')}}" class="h-10"> Home Delivery
                                    </a>
                                </div>
                                <div class="tab-content border-r border-l border-b p-2 sm:p-4">
                                    <div x-show="tab === 'email'" class="" x-transition>
                                        <h6 class="text-success font-semibold my-6">Instant Delivery</h6>
                                        <div class="grid grid-col-1 sm:grid-cols-2 gap-6 transition ease-in-out">
                                            <div class="form control">
                                                <x-floating-input id="recipient_name" :label="__('Recipients Name')" wire:model.defer="email_recipient_name" wrapperClass="" type="text" placeholder="__('Recipients Name')" :value="old('recipient_name')" />
                                                @error('email_recipient_name')
                                                <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form control">
                                                <x-floating-input id="recipient_email" :label="__('Recipients Email')" wire:model.defer="email_recipient_email" wrapperClass="" type="email" placeholder="__('Recipients Email')" :value="old('recipient_email')" />
                                                @error('email_recipient_email')
                                                <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form control">
                                                <x-floating-input id="phone" :label="__('Recipients Number')" wire:model.defer="email_recipient_phone" wrapperClass="" type="text" placeholder="__('Phone Number')" :value="old('phone')" />
                                                @error('email_recipient_phone')
                                                <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div x-transition x-show="tab === 'delivery'">
                                        <div class="grid grid-col-1 sm:grid-cols-2 gap-6">
                                            <div class="form-control w-full col-span-2">
                                                <x-textarea wire:model.defer="delivery_address" placeholder="Address" row="2" wrapperClass="" />
                                                @error('delivery_address')
                                                <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-control w-full">
                                                <x-floating-input id="city" :label="__('City')" wire:model.defer="delivery_city" wrapperClass="" type="text" placeholder="__('City')" :value="old('city')" />
                                                @error('delivery_city')
                                                <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-control w-full">
                                                <x-floating-input id="state" :label="__('State')" wire:model.defer="delivery_state" wrapperClass="" type="text" placeholder="__('State')" :value="old('state')" />
                                                @error('delivery_state')
                                                <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-control w-full col-span-2">
                                                <x-floating-select id="country" label="Select country" name="design_category" wrapperClass="w-full" wire:model="delivery_country">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </x-floating-select>
                                                @error('delivery_country')
                                                <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <x-button class="btn btn-secondary" wire:loading.class="loading" wire:target="save">Proceed to Checkout</x-button>

                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            @if(1>3)
                            <div class="card min-h-96 bg-repeat bg-clip-padding" x-bind:style="`background-image: url(${selected_design_bg})`">
                                <div class="card-body p-2">
                                   <div class="w-1/2">

                                   </div>
                                    <div class="w-1/2 grid grid-cols-1 bg-white rounded-lg">
                                        <div class="bg-white rounded-lg">
                                            <textarea name="" rows="3" class=""></textarea>
                                        </div>
                                        <div class="bg-white rounded-lg">
                                            <input type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-span-1">
                <div class="card bg-white sticky top-0">
                    <div class="card-body p-2">
                        <div class="w-full rounded-lg bg-white overflow-hidden transition duration-500 relative p-2 sm:p-4">

                            <div class="bg-contain w-10 mx-auto h-4" style="background-image: url({{Storage::url('gift-pin.png')}})"></div>
                            <h3 class="text-center font-bold text-xs sm:text-sm mt-4 mb-4 text-primary line-clamp-1">{{$product->title}}</h3>
                            <div class="flex flex-col">
                                <a href="{{ route('product.show', $product->slug) }}" class="flex flex-col h-full justify-center relative ">
                                    <img class="rounded-lg w-full" src="{{$product->featured_img_thumb}}" alt="{{$product->title}}" />

                                    {{--        <div class="absolutee right-2 bottom-0">--}}
                                    {{--            <span class="btn btn-primary btn-circle justify-end text-right text-xs  rounded-full mx-5">{{ app_money_format($product->min_price) }}</span>--}}
                                    {{--        </div>--}}

                                    <span class="bg-primary text-white mx-auto py-1 px-2 sm:px-4 rounded-full -mt-3 sm:-mt-3 justify-center text-xs uppercase">
                {{ __('Gift Card') }}
            </span>
                                </a>

                                <div class="px-2 sm:px-4 py-3 text-center">
                                    <h3 class="text-gray-700 text-xs sm:text-sm font-normal line-clamp-2">{{$product->subheading}}</h3>
                                    {{--        <span class="text-gray-500 mt-2 text-sm">{{ app_money_format($product->min_price) }}</span>--}}
                                </div>
                            </div>




                            {{--    <div class="flex items-end justify-end h-40 w-full bg-cover" style="background-image: url('{{$product->featured_img_thumb}}')">--}}

                            {{--        <button class="btn btn-primary btn-circle rounded-full mx-5 -mb-4">--}}
                            {{--            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>--}}
                            {{--        </button>--}}
                            {{--    </div>--}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function order() {
            return {
                amount: @entangle('amount'),
                design_category: @entangle('design_category'),
                designs: @js($messageDesigns),
                selected_design: @entangle('selected_design').defer,
                selected_design_bg: '{{$messageDesigns[0]->getFirstMediaUrl('featured_url')}}',
                swiper: null,
                personal_message: '',
                special_notes:'',
                tab: @entangle('delivery_type').defer,
                personal_message_limit: 250,
                async filteredDesigns() {
                    if (this.design_category == null) {
                        return this.designs;
                    }
                    const filteredItem = this.designs.filter((item) => {
                        return this.design_category === item.message_category_id;
                    })
                    return filteredItem;
                }
            }
        }
    </script>
</div>


