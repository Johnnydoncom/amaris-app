<div>
    <div x-data="{verifyType: @js($verificationTypes[0]->id) }" class="card rounded-none">
        <div class="card-body p-1 sm:p-auto">
            <h2 class="font-semibold text-xl sm:text-2xl">Account Verification</h2>
            <div class="divider my-0"></div>
            @if($verified)
                Account Verified
            @else

                <form method="POST" wire:submit.prevent="verify" class="flex flex-col gap-4 w-full sm:w-1/2 mt-4">
                    @csrf

                    @if($verification_record)
                        <x-floating-select x-model="verifyType" wire:model="verifyType" id="verifyType" label="Verification Type" name="verifyType" wrapperClass="w-full" placeholder="Verification Type" readonly>
                            <option value="">Select</option>
                            @foreach($verificationTypes as $vtype)
                                <option value="{{$vtype->id}}" @if($verification_record && $vtype->id==$verification_record->verification_type_id) selected @endif>{{$vtype->name}}</option>
                            @endforeach
                        </x-floating-select>
                    @else
                        <x-floating-select x-model="verifyType" wire:model="verifyType" id="verifyType" label="Verification Type" name="verifyType" wrapperClass="w-full" placeholder="Verification Type">
                            <option value="">Select</option>
                            @foreach($verificationTypes as $vtype)
                                <option value="{{$vtype->id}}" @if($verification_record && $vtype->id==$verification_record->verification_type_id) selected @endif>{{$vtype->name}}</option>
                            @endforeach
                        </x-floating-select>
                    @endif

                    @if($verifyType == 1)
                        @if($verification_record)
                            <x-floating-input id="nin" label="National Identification Number *" name="id_no" wrapperClass="w-full" wire:model.defer="id_no" type="text" placeholder="National Identification Number" value="{{$verification_record->id_no}}" readonly="readonly" />
                        @else
                            <x-floating-input id="nin" label="National Identification Number *" name="id_no" wrapperClass="w-full" wire:model.defer="id_no" type="text" placeholder="National Identification Number" />
                        @endif

                    @elseif($verifyType==2)
                        @if($verification_record)
                            <x-floating-input id="passport_no" label="Passport Number *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Passport Number" readonly />
                        @else
                            <x-floating-input id="passport_no" label="Passport Number *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Passport Number" required autofocus />
                        @endif
                    @elseif($verifyType==3)
                        @if($verification_record)
                        <x-floating-input id="dv_license_no" label="Drivers License Number *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Driver's License Number" readonly />
                        @else
                            <x-floating-input id="dv_license_no" label="Drivers License Number *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Driver's License Number" required autofocus />
                        @endif
                    @elseif($verifyType==4)
                        @if($verification_record)
                        <x-floating-input id="vin" label="VIN *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="VIN" readonly />
                        @else
                            <x-floating-input id="vin" label="VIN *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="VIN" required autofocus />
                        @endif
                    @endif

                    @if($verification_record)
                        <img src="{{$verification_record->getFirstMediaUrl('doc')}}" class="w-32 h-32" alt="Doc">
                    @else
                        <x-file-attachment wire:model="verifyDoc" :file="$verifyDoc" />
                    @endif

                    @if(!$verified)
                        <div class="col-span-1 sm:col-span-2">
                            @if(isset($verification_record) && $verification_record->status=='pending')
                            <x-button class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="verify" wire:loading.attr="disabled" disabled="disabled">{{ __('Verify Account') }}</x-button>
                            @else
                                <x-button class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="verify" wire:loading.attr="disabled">{{ __('Verify Account') }}</x-button>
                            @endif
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
