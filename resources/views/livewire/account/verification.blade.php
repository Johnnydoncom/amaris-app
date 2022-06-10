<div>
    <div x-data="{verifyType: @js($verificationTypes[0]->id) }" class="card rounded-none">
        <div class="card-body p-1 sm:p-auto">
            <h2 class="font-semibold text-xl sm:text-2xl">Account Verification</h2>
            <div class="divider my-0"></div>
            @if($verified)
                Verified
            @else

                <form method="POST" wire:submit.prevent="verify" class="flex flex-col gap-4 w-full sm:w-1/2">
                    @csrf
                    <x-floating-select x-model="verifyType" wire:model="verifyType" id="verifyType" :label="__('Verification Type')" name="verifyType" wrapperClass="w-full" placeholder="__('Verification Type')">
                        <option value="">Select</option>
                        @foreach($verificationTypes as $vtype)
                            <option value="{{$vtype->id}}" @if($verification_record && $vtype->id==$verification_record->verification_type_id) selected @endif>{{$vtype->name}}</option>
                        @endforeach
                    </x-floating-select>

                    @if($verifyType == 1)
                        <x-floating-input id="nin" :label="__('NIN *')" name="nin" wrapperClass="w-full" wire:model.defer="nin" type="text" placeholder="__('National Identification Number')" />

                    @elseif($verifyType==2)

                        <x-floating-input id="passport_no" :label="__('Passport Number *')" name="passport_no" wrapperClass="" wire:model.defer="passport_no" type="text" placeholder="__('Passport Number')" required autofocus />

                    @elseif($verifyType==3)
                        <x-floating-input id="dv_license_no" :label="__('Drivers License Number *')" name="dv_license_no" wrapperClass="" wire:model.defer="dv_license_no" type="text" placeholder="__('Driver's License Number')" required autofocus />
                    @elseif($verifyType==4)
                        <x-floating-input id="vin" :label="__('VIN *')" name="vin" wrapperClass="" wire:model.defer="vin" type="text" placeholder="__('VIN')" required autofocus />

                    @endif

{{--                    <x-file-attachment wire:model="verifyDoc" :file="$verifyDoc" required="required" />--}}
                    <x-file-attachment wire:model="verifyDoc" :file="$verifyDoc" />

                    @if(!$verified)
                        <div class="col-span-1 sm:col-span-2">
                            <x-button class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="verify" wire:loading.attr="disabled">{{ __('Verify Account') }}</x-button>
                        </div>
                    @endif
                </form>

            @endif
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
</div>
