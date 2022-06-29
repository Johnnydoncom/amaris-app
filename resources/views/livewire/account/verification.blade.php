<div>
    <div x-data="{verifyType: @js($verificationTypes[0]->id) }" class="card rounded-none">
        <div class="card-body p-1 sm:p-auto">
            <h2 class="font-semibold text-xl sm:text-2xl">Account Verification</h2>
            <div class="divider my-0"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-card>
                    <div class="flex justify-between gap-4">
                        <h4 class="font-semibold text-lg mb-4">ID Verification</h4>
                    </div>

                    @if(Auth::user()->verified)

                        <div class="flex flex-col justify-center items-center gap-0">
                            <x-cui-cil-check-circle class="w-14 h-14 sm:w-14 sm:h-14 text-success"/>
                            <span class="font-semibold">ID Verified</span>
                        </div>


                    @elseif($verification_record && $verification_record->status=='pending')

                        <div class="grid grid-cols-1 gap-4 my-4">
                            <div class="">
                                <ul class="leading-7 text-sm">
                                    <li class="flex justify-between gap-4"><span>ID Type</span><span>{{$verification_record->verification_type->name }}</span></li>
                                    <li class="flex justify-between gap-4"><span>ID No</span><span>{{$verification_record->id_no }}</span></li>
                                    <li class="flex justify-between gap-4"><span>Surname</span><span>{{$verification_record->last_name}}</span></li>
                                    <li class="flex justify-between gap-4"><span>First Name</span><span>{{$verification_record->first_name}}</span></li>
                                    <li class="flex justify-between gap-4"><span>Middle Name</span><span>{{$verification_record->middle_name}}</span></li>
                                    <li class="flex justify-between gap-4"><span>Email</span><span>{{$verification_record->email}}</span></li>
                                    <li class="flex justify-between gap-4"><span>Phone</span><span>{{$verification_record->phone}}</span></li>
                                    <li class="flex justify-between gap-4"><span>Date of Birth</span><span>{{$verification_record->dob}}</span></li>
                                    <li class="flex justify-between gap-4"><span>Gender</span><span>{{$verification_record->gender}}</span></li>
                                    <li class="flex justify-between gap-4"><span>Marital Status</span><span class="uppercase"> {{$verification_record->marital_status}}</span></li>
                                    <li class="flex justify-between gap-4 font-semibold"><span>Status</span>
                                        @if($verification_record->status=='pending')
                                            <span class="text-warning font-semibold">{{ucfirst($verification_record->status)}}</span>
                                        @elseif($verification_record->status=='verified')
                                            <span class="text-success font-semibold">{{ucfirst($verification_record->status)}}</span>
                                        @else
                                            <span class="text-error font-semibold">{{ucfirst($verification_record->status)}}</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="font-semibold">Front ID</h3>
                                    <img src="{{$verification_record->getFirstMediaUrl('doc')}}" alt="Uploaded file" class="w-48 object-cover">
                                </div>

                                @if($verification_record->getFirstMediaUrl('doc_back'))
                                <div>
                                    <h3 class="font-semibold">Back ID</h3>
                                    <img src="{{$verification_record->getFirstMediaUrl('doc_back')}}" alt="Uploaded file" class="w-48 object-cover">
                                </div>
                                @endif


                            </div>
                        </div>
                    @else

                    <form method="POST" wire:submit.prevent="verify" class="flex flex-col gap-4 w-full mt-4">
                        @csrf
                        <div class="form-control">
                            <x-floating-select label="ID Type" id="verifyType" wire:model="verifyType">
                                @foreach($verificationTypes as $vtype)
                                    <option value="{{$vtype->id}}" @selected($verification_record && $vtype->id==$verification_record->verification_type_id)>{{$vtype->name}}</option>
                                @endforeach
                            </x-floating-select>
                        </div>

                        @if($verifyType)
                            <div class="space-y-4" wire:loading.remove wire:target="verifyType">
                                @switch($verificationTypes->find($verifyType)->slug)
                                    @case(\Illuminate\Support\Str::lower('NIN'))
                                    <x-floating-input id="nin" label="National Identification Number *" name="id_no" wrapperClass="w-full" wire:model.defer="id_no" type="text" placeholder="National Identification Number" />

                                    <div class="form-control">
                                        <x-label>Front ID</x-label>
                                        <x-file-attachment id="frontId" wire:model="frontId" :file="$frontId" />
                                    </div>

                                    <div class="form-control">
                                        <x-label>Back ID</x-label>
                                        <x-file-attachment id="backId" wire:model="backId" :file="$backId" />
                                    </div>
                                    @break
                                    @case(\Illuminate\Support\Str::lower('PASSPORT'))
                                    <x-floating-input id="passport_no" label="Passport Number *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Passport Number" />

                                    <div class="form-control">
                                        <x-label>Front ID</x-label>
                                        <x-file-attachment id="frontId" wire:model="frontId" :file="$frontId" />
                                    </div>
                                    @break
                                    @case(\Illuminate\Support\Str::lower('DRIVERSLICENSE'))
                                    <x-floating-input id="dv_license_no" label="Drivers License Number *" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Driver's License Number" />

                                    <div class="form-control">
                                        <x-label>Front ID</x-label>
                                        <x-file-attachment id="frontId" wire:model="frontId" :file="$frontId" />
                                    </div>

                                    <div class="form-control">
                                        <x-label>Back ID</x-label>
                                        <x-file-attachment id="backId" wire:model="backId" :file="$backId" />
                                    </div>
                                    @break
                                    @case(\Illuminate\Support\Str::lower('VOTERSCARD'))
                                    <x-floating-input id="vin" label="VIN *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="VIN" />

                                    <div class="form-control">
                                        <x-label>Front ID</x-label>
                                        <x-file-attachment id="frontId" wire:model="frontId" :file="$frontId" />
                                    </div>

                                    <div class="form-control">
                                        <x-label>Back ID</x-label>
                                        <x-file-attachment id="backId" wire:model="backId" :file="$backId" />
                                    </div>
                                    @break
                                @endswitch



                                <x-button class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="verify" wire:loading.attr="disabled" :disabled="!$frontId">{{ __('Confirm') }}</x-button>
                            </div>
                            <div wire:loading wire:target="verifyType">Loading...</div>
                        @endif
                    </form>

                    @endif
                </x-card>
                <x-card class="relative">

                    @if(Auth::user()->address_verified)
                        <div class="flex flex-col justify-center items-center gap-0">
                            <x-cui-cil-check-circle class="w-14 h-14 sm:w-14 sm:h-14 text-success"/>
                            <span class="font-semibold">Address Verified</span>
                        </div>
                    @elseif($address_verification_record)
                        <ul class="leading-7 text-sm">
                            <li class="flex justify-between gap-4"><span>Address</span><span>{{Auth::user()->address }}</span></li>
                            <li class="flex justify-between gap-4"><span>City</span><span>{{Auth::user()->city}}</span></li>
                            <li class="flex justify-between gap-4"><span>State</span><span>{{Auth::user()->state}}</span></li>
                            <li class="flex justify-between gap-4"><span>Country</span><span>{{Auth::user()->country->name}}</span></li>
                            <li class="flex justify-between gap-4"><span>Zip Code</span><span>{{Auth::user()->zipcode}}</span></li>
                            <li class="flex justify-between gap-4"><span>Status</span><span class="text-warning font-semibold">{{ucfirst($address_verification_record->status)}}</span></li>
                        </ul>
                    @else
                        @if(!Auth::user()->verified)
                        <div class="z-20 bg-white/50 absolute w-full h-full"></div>
                        @endif
                        <form class="" wire:submit.prevent="verifyAddress">
                            <h4 class="font-semibold text-lg mb-4">Address Verification</h4>
                            <x-file-attachment id="utilityBill" wire:model="utilityBill" :file="$utilityBill" />
                        </form>
                    @endif
                </x-card>
            </div>
        </div>
    </div>

    <x-flash-messages />
{{--    @if(session()->has('message'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
</div>
