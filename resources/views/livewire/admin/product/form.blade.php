<div>
    <form wire:submit.prevent="store">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div x-data="{openAttrTab:false, selAttribute:'', product_type:'simple', tab:'general'}" class="grid grid-cols-1 md:grid-cols-3 gap-2">

            <div class="md:col-span-2">
                <x-card class="card shadow-xl">
                    <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">@if($product) Edit Product @else Add New Product @endif</h5>
                    <hr>

                    <div class="form-control mb-2 mt-4">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title" name="title" :value="old('title')" required autofocus />
                        @error('title')  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label> @enderror
                    </div>
                    <div class="form-control mb-2 mt-2">
                        <x-label for="slug" :value="__('Slug')" />
                        <x-input id="slug" class="block mt-1 w-full" type="text" wire:model="slug" name="slug" :value="old('slug')" required />
                        @error('slug')  <label class="label"><span class="label-text-alt text-error">{{ $message }}</span></label> @enderror
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-2 mt-2">
                        <div class="form-control w-full">
                            <x-label value="Regular Price" class="label" />
                            <x-input type="text" wire:model.defer="regular_price" class="w-full input input-bordered input-md"/>
                            @error('regular_price') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-control w-full">
                            <x-label class="label" value="Sales Price" />
                            <x-input type="text" wire:model.defer="sales_price" class="w-full input input-bordered input-md"/>
                            @error('sales_price') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-control w-full">
                            <x-label class="label" value="Quantity In Stock" />
                            <x-input type="text" wire:model.defer="stock_quantity" class="w-full input input-bordered input-md"/>
                            @error('stock_quantity') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="py-4 form-control" wire:ignore>
                        <x-label for="description" :value="__('Description')" />
                        <x-input.tinymce wire:model.defer="description" placeholder="Type anything you want..." />
                    </div>
                </x-card>
            </div>



            {{--Sidebar--}}
            <x-card class="card shadow-xl space-y-4">
                <div class="form-control">
                    <x-label for="image" :value="__('Featured Image')" />
                    @if($product)
                        <img src="{{$product->featured_img_thumb}}" class="h-44 object-cover mx-auto">
                        <x-file-attachment wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png,image/webp" />

                    @else
                        <x-file-attachment wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png,image/webp" required="required" />
                    @endif
                </div>

                <div class="form-control">
                    <x-label for="image" :value="__('Product Gallery')" />

                    <div class="grid grid-cols-4 gap-2">
                        @if($product && $product->gallery_images)
                            @foreach ($product->gallery_images as $image)
                                <div class="relative">
                                    <img src="{{ $image->getUrl('thumb') }}" class="">
                                    <a class="absolute right-0 top-0 cursor-pointer text-error" wire:click="removeGalleryById({{ $image->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </a>
                                </div>
                            @endforeach
                        @endif

                        @if($images && count($images) > 0)
                            @foreach ($images as $key => $img)

                                <div class="relative">
                                    <img src="{{ $img->temporaryUrl() }}" class="">
                                    <a class="absolute right-0 top-0 cursor-pointer text-error" wire:click="removeGallery({{ $key }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </a>
                                </div>
                            @endforeach
                        @endif

                        <div class="relative rounded-md shadow-sm">
                            <label class="p-6 flex flex-col items-center tracking-wide uppercase  border border-blue cursor-pointer text-purple-600 ease-linear transition-all duration-150 relative">
                                <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                                <input type="file" class="hidden" wire:model="images" accept="image/jpg,image/jpeg,image/png,image/webp" multiple>
                            </label>
                        </div>

                    </div>

                    <div wire:loading wire:target="images">Uploading...</div>
                    @error('images.*') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-control w-full">
                    <x-label class="label" value="Category" />
                    <x-select class="w-full" wire:model.defer="category_id" name="category_id">
                        <option value="" wire:key="">Select</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" wire:key="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </x-select>
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

                <x-button type="submit" class="btn-primary btn-block mt-4" wire:loading.class="loading" wire:target="store">
                    Publish
                </x-button>

                <div wire:loading wire:target="store">Please wait...</div>
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
