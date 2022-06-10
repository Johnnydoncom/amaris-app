<div>
    <form wire:submit.prevent="store">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div x-data="{openAttrTab:false, selAttribute:'', product_type:'simple', tab:'general'}" class="grid grid-cols-1 md:grid-cols-3 gap-2">

            <div class="md:col-span-2">
                <x-card class="card shadow-xl">
                    <x-slot name="title"><h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">@if($product) Edit Product @else Add New Product @endif</h5></x-slot>
                    <hr>

                    <div class="form-control mb-4 mt-4">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" wire:model.defer="title" name="title" :value="old('title')" required autofocus />
                        @error('title')  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label> @enderror
                    </div>

                    <div class="py-6 form-control" wire:ignore>
                        <x-label for="description" :value="__('Description')" />
                        <x-input.tinymce wire:model.defer="description" placeholder="Type anything you want..." />
                    </div>

                    <div>
                        <h2 class="font-semibold text-xl mb-4">Add Variations</h2>
                        <div class="py-3">
                            @foreach($inputs as $key => $value)
                            <div class="variation border border-primary mb-2 p-2">
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    <div class="form-control w-full">
                                        <x-label class="label" value="Variation Name" />
                                        <x-input type="text" wire:model="inputs.{{ $key }}.variation_name" class="w-full input-md"/>
                                        @error('inputs.'.$key.'.variation_name') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-control w-full">
                                        <x-label class="label" value="Quantity In Stock" />
                                        <x-input type="text" wire:model.defer="inputs.{{ $key }}.stock_quantity" class="w-full input input-bordered input-md"/>
                                        @error('inputs.'.$key.'.stock_quantity') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-control w-full">
                                        <x-label value="Regular Price" class="label" />
                                        <x-input type="text" wire:model.defer="inputs.{{ $key }}.regular_price" class="w-full input input-bordered input-md"/>
                                        @error('inputs.'.$key.'.regular_price') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-control w-full">
                                        <x-label class="label" value="Sales Price" />
                                        <x-input type="text" wire:model.defer="inputs.{{ $key }}.sales_price" class="w-full input input-bordered input-md"/>
                                        @error('inputs.'.$key.'.sales_price') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-error btn-sm" wire:click.prevent="remove({{$key}})">Remove</button>
                                </div>
                            </div>

                            @endforeach

                            <x-button type="button" class="btn btn-secondary btn-sm self-end justify-self-end" wire:loading.class="loading" wire:target="add" wire:click.prevent="add">Add Variation</x-button>
                        </div>
                    </div>
                </x-card>
            </div>



            {{--Sidebar--}}
            <x-card class="card shadow-xl space-y-4">
                <div class="form-control">
                    <x-label for="brand" :value="__('Featured Image')" />
                    <x-file-attachment wire:model="image" :file="$image" required="required" />
                </div>

                <div class="form-control w-full">
                    <x-label class="label" value="Platform" />
                    <x-select class="w-full" wire:model.defer="platform_id" name="platform_id">
                        <option value="" wire:key="">Select</option>
                        @foreach ($platforms as $platform)
                        <option value="{{$platform->id}}" wire:key="{{$platform->id}}">{{$platform->name}}</option>
                        @endforeach
                    </x-select>
                </div>


                <div class="form-control">
                    <x-label for="brand" :value="__('Country')" />
                    <x-select class="w-full" wire:model.defer="country_id" name="country_id">
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" wire:key="{{$country->id}}">{{ $country->name }}</option>
                        @endforeach
                    </x-select>
                    @error('country_id')  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label> @enderror
                </div>

                <div class="form-control">
                    <x-checkbox wire:model.defer="featured" id="featured" label="{{ __('Featured') }}" type="checkbox" name="featured" />
                </div>

                <div class="form-control mb-2">
                    <x-label for="status" :value="__('Status')" />
                    <x-select id="status" class="mt-1 w-full" wire:model.defer="status"  name="status" required>
                        <option value="0" wire:key="0">Draft</option>
                        <option value="1" wire:key="1">Published</option>
                    </x-select>
                </div>

                <x-button type="submit" class="btn-primary btn-block mt-4">
                    Publish
                </x-button>

                <div wire:loading wire:target="store">process...</div>
            </x-card>
            {{--            </div>--}}
        </div>
    </form>


    <script>
        document.addEventListener('livewire:load', function () {
            // Livewire.on('attributeSelected', response => {
            //     alert(1)
            // })

            @this.on('attributeSelected', () => {
                // alert(1)
            });
        });

        window.addEventListener('attribute-selected', event => {

            // alert('Name updated to: tt');

        })
     </script>
</div>


@push('styles')
    {{--    <link--}}
    {{--      href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css"--}}
    {{--      rel="stylesheet"--}}
    {{--    />--}}

{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
@endpush
@push('scripts')


    <script>


        // $(document).ready(function() {
        //     $('#country').select2();
        //     $('#country').on('change', function (e) {
        //         var data = $('#country').select2("val");
        //     @this.set('country_id', data);
        //     });
        //
        // });

    </script>
@endpush
