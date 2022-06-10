<div>
{{--    <x-slot name="title">{{$product->title}}</x-slot>--}}
    <div class="py-1 relative mx-0 product bg-white" id="single-product" x-data="order()">
        <form method="post" wire:submit.prevent="save()">
            @csrf
            <div class="lg:p-4 container z-0 relative product-summary px-0 pl-0 bg-white" style="">
                <div class="grid grid-cols-1 lg:grid-cols-4 sm:gap-8 gap-8 mb-4">
                    <div class="lg:col-span-2 " wire:ignore>
                        <div class="swiper gallery-slider">
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach($gallery as $key => $slide)
                                    <div class="swiper-slide bg-white">
                                        <img src="{{ $slide }}" class="rounded w-full">
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 sm:border-4 sm:border-secondary">
                        <div class="w-full lg:p-10 lg:py-6 mb-6 lg:mb-0 max-h-full">
                            <h2 class="text-xs sm:text-sm title-font text-gray-500 tracking-widest uppercase">{{__('Gift Card')}}</h2>
                            <h1 class="text-gray-900 text-xl sm:text-2xl title-font font-semibold mb-0 line-clamp-2">{{$product->title}}</h1>
                            <p class="leading-relaxed text-xs mb-0">Validity: {{$product->validity}} {{\Illuminate\Support\Str::plural('Month', $product->validity)}} from the date of issue.</p>
                            <p class="leading-relaxed text-xs mb-0">Delivery: Instant Delivery</p>
                            <p class="leading-relaxed text-xs mb-4">Redemption: {{$product->redemption_type}}</p>

                            <x-label class="mb-1 font-normal">
                                Choose Card Value
                            </x-label>
                            <div class="flex gap-0 items-center flex-wrap justify-center sm:justify-start sm:flex-nowrap">
                                <x-floating-select id="amount" label="Card Value" name="amount" wrapperClass=" w-full"  wire:model="amount" x-model="amount" autofocus>
                                    <option value="">Select Amount</option>
                                    @foreach($popularAmounts as $pamount)
                                        <option value="{{$pamount}}">{{$pamount}}</option>
                                    @endforeach
                                </x-floating-select>

                                <div class="divider divider-horizontal sm:divider-vertical sm:mx-0">OR</div>

                                <div class="form-control w-full">
                                    {{--                                    <x-label value="Custom Amount" wire:model="amount" />--}}
                                    <div class="form-control">
                                        <x-floating-input label="Custom Amount" type="number" x-model="amount" wire:model.defer="amount" class="" placeholder="0.00" />
                                    </div>
                                </div>
                            </div>
                            @error('amount')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror


                            <div class="mt-4 flex gap-8">
                                <div class="w-full sm:w-1/2">
                                    <x-label value="Quantity" />
                                    <x-floating-input label="Quantity" @click="if(quantity<1){quantity=1;}" id="quantity" type="number" x-model="quantity" wire:model.defer="quantity" min="1" wrapperClass="w-full" placeholder="" />
                                </div>

                                <div class="w-full sm:w-1/2">


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="delivery-options">
                    <h5 class="font-semibold mb-4"> How would you like to deliver this Gift Card? </h5>
                    <div class="w-full sm:w-2/3 mb-4">
                        <div class="flex justify-start">
                            <x-radio name="mode" value="email" x-model="delivery_type" wire:model.defer="delivery_type" wrapperClass="form-check-inline" label="Email" id="byemail" />
                            <x-radio name="mode" value="sms" x-model="delivery_type" wire:model.defer="delivery_type" wrapperClass="form-check-inline" label="SMS" id="bysms" />
                            <x-radio name="mode" value="both" x-model="delivery_type" wire:model.defer="delivery_type" wrapperClass="form-check-inline" label="Both" id="byboth" />
                        </div>


                    </div>
                    <div class="grid grid-col-1 sm:grid-cols-3 gap-4 transition ease-in-out mb-4">
                        <div class="form control">
                            <x-floating-input id="recipient_name" :label="__('Recipients Name')" wire:model.defer="recipient_name" x-model="recipient_name" wrapperClass="" type="text" placeholder="__('Recipients Name')" :value="old('recipient_name')" />
                            @error('recipient_name')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form control" x-show="delivery_type=='email' || delivery_type=='both'">
                            <x-floating-input id="recipient_email" :label="__('Recipient Email')" wire:model.defer="recipient_email" wrapperClass="" type="email" placeholder="__('Recipient Email')" :value="old('recipient_email')" />
                            @error('recipient_email')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form control" x-show="delivery_type=='sms' || delivery_type=='both'">
                            <x-floating-input id="phone" :label="__('Recipient Number')" wire:model.defer="recipient_phone" wrapperClass="" type="text" placeholder="__('Phone Number')" :value="old('phone')" />
                            @error('recipient_phone')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control">
                            <x-textarea wire:model.defer="personal_message" x-model="personal_message" x-ref="personal_message" x-bind:maxlength="personal_message_limit" placeholder="Personal Message" row="10" />
                        </div>
                    </div>
                </div>

                <div class="design">
                    <h5 class="font-semibold mb-4"> Personalise your gift card </h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <div class="flex items-center gap-4">
                                <div class="w-full sm:w-1/2">
                                    <x-floating-select id="amount" label="Choose Theme" name="design_category" wrapperClass=" w-full"  wire:model.defer="design_category" x-model="design_category">
                                        <option value="">Show All</option>
                                        @foreach($designCategories as $dcat)
                                            <option value="{{$dcat->id}}">{{$dcat->name}}</option>
                                        @endforeach
                                    </x-floating-select>
                                </div>
                            </div>
                            <div class="designs grid grid-cols-5 gap-2 mt-4">
                                <template x-for="design in filteredDesigns">
                                    <label x-bind:for="`design-${design.id}`" @mouseover="selected_design_bg = design.featured_image" class="card card-body p-1 bg-white border hover:border-primary shadow rounded-md" :class="{'border-primary': selected_design == design.id}">
                                        <img class="object-cover rounded-md" x-bind:src="design.featured_thumbnail_url" x-bind:alt="design.title">
                                        <input x-bind:id="`design-${design.id}`" type="radio" class="hidden" x-bind:value="design.id" x-model="selected_design">
                                        <h5 class="text-xs line-clamp-2" x-text="design.title"></h5>
                                    </label>
                                </template>
                            </div>
                        </div>
                        <div>
                            <div class="border-2 border-dashed shadow-lg rounded-b-md mb-4">
                               <h6 class="-mt-4 mb-2 font-semibold">Preview</h6>
                                <div class="previewImg">
                                    <img x-bind:src="selected_design_bg" class="min-h-44 max-h-56 object-coverr object-fill w-full">
                                </div>
                                <div class="p-2">
                                    <div class="">
                                        <div class="text-sm font-semibold" x-text="'Hi '+ (recipient_name ? recipient_name : 'Receiver')">Hi Receiver,</div>
                                        <div class="text-sm mt-2">You've got a {{config('app.name')}} E-Gift Voucher</div>
                                    </div>
                                    <div class="messagePreview py-2">
                                        <p class="italic font-semibold" x-text="(personal_message ? personal_message : 'Your message will appear here')"> </p>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                        <div class="">
                                            <img src="{{$product->getFirstMediaUrl('featured_image', 'thumb')}}" alt="{{$product->title}}" class="rounded-lg w-full">
                                        </div>
                                        <div class="space-y-4">
                                            <h2 class="text-3xl font-bold">{{app_money_format($amount, currency()->getUserCurrency())}}</h2>
                                            <div>
                                                <p class="text-xs font-bold">Card Number</p>
                                                <p class="text-xs font-bold">{{ \Illuminate\Support\Str::mask(\Illuminate\Support\Str::random(),'x', 0) }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold">PIN</p>
                                                <p class="text-xs font-bold">{{ \Illuminate\Support\Str::mask(123456,'x', 0) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-primary text-xs mt-4">* Validity: xx xx xxxx</p>
                                </div>
                            </div>

                            <div class="flex sticky bottom-0 pb-5 sm:pb-0 items-center bg-white">
                                <x-button wire:loading.class="loading" wire:target="save" x-bind:disabled="amount<1" type="submit" class="btn btn-primary">Pick This Gift Card</x-button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </form>


        <section class="description sm:mt-6 mt-4 bg-gray-100 py-4 sm:py-6">
            <div class="container">
                <div class="flex mb-4 border-b-2 border-gray-300 gap-4 sm:gap-8">
                    <a :class="{ 'active border-b-2 text-primary border-primary': tab === 'description' }" x-on:click.prevent="tab = 'description'" class="flex-groww py-2 text-sm sm:text-lg px-1" href="#">Description</a>
                    <a :class="{ 'active border-b-2 text-primary border-primary': tab === 'redemption-info' }" x-on:click.prevent="tab = 'redemption-info'" class="flex-groww py-2 text-sm sm:text-lg px-1" href="#">Redemption</a>
                    <a :class="{ 'active border-b-2 text-primary border-primary': tab === 'locations' }" x-on:click.prevent="tab = 'locations'" class="flex-groww py-2 text-sm sm:text-lg px-1" href="#">Locations</a>
                </div>

                <div x-show="tab === 'description'">
                    <div class="text-sm">
                        {!! $product->description !!}
                    </div>
                </div>

                <div x-show="tab === 'redemption-info'">
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>

                <div x-show="tab === 'locations'">
                    <p>
                        locations
                    </p>
                </div>
            </div>
        </section>

        @if($related->count())
            <section class="mb-0 mt-4">
                <div class="container">
                    <h2 class="font-semibold mb-4 text-md sm:text-xl">You may also like</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        @foreach($related as $rp)
                            <x-product.layout-two :product="$rp" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <script>
            function order() {
                return {
                    quantity: 1,
                    amount: @entangle('amount'),
                    design_category: @entangle('design_category'),
                    designs: @js($messageDesigns),
                    selected_design: @entangle('selected_design').defer,
                    selected_design_bg: '{{ $messageDesigns[0]->featured_image }}',
                    swiper: null,
                    personal_message: @entangle('personal_message').defer,
                    recipient_name:@entangle('recipient_name').defer,
                    tab: 'description',
                    delivery_type:@entangle('delivery_type'),
                    personal_message_limit: 250,
                    get filteredDesigns() {
                        if (this.design_category == null || this.design_category == '') {
                            return this.designs;
                        }
                        return this.designs.filter((item) => {
                            return this.design_category == item.message_category_id;
                        });
                    }
                }
            }
        </script>
    </div>


    @push('styles')
        <link rel="stylesheet" href="{{ mix('css/swiper-bundle.min.css')}}">
    @endpush
    @push('scripts')
        <script src="{{ mix('js/swiper-bundle.js')}}"></script>
        <script>
            (() => {
                const initSlider = () => {
                    var gallerySwiper = new Swiper('.gallery-slider', {
                        slidesPerView: 1.3,
                        lazy:true,
                        grabCursor: true,
                        loop: true,
                        freeMode: true,
                        spaceBetween: 10,
                        centeredSlides:true,
                        scrollbar: {
                            el: '.swiper-scrollbar',
                            hide: true
                        },
                        autoplay:{
                            delay: 5000,
                            disableOnInteraction: false
                        },
                        effect: 'fade',
                        fadeEffect: {
                            crossFade: true
                        },
                        navigation:false,
                        breakpoints: {
                            991: {
                                slidesPerView: 1,
                                spaceBetween: 10,
                                height: 350
                            }
                        }
                    })
                }

                initSlider();

            })();
        </script>

    @endpush

</div>
