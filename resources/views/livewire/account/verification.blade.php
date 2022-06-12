<div>
    <div x-data="{verifyType: @js($verificationTypes[0]->id) }" class="card rounded-none">
        <div class="card-body p-1 sm:p-auto">
            <h2 class="font-semibold text-xl sm:text-2xl">Account Verification</h2>
            <div class="divider my-0"></div>
            @if($verified)
                Account Verified

            @elseif($verification_record && $verification_record->status=='pending')

                <div class="grid grid-cols-3 gap-8">
                    <div class="">
                        <ul>
                            <li class="flex justify-between gap-4 font-bold"><span>ID Type</span><span>{{$verification_record->verification_type->name }}</span></li>
                            <li class="flex justify-between gap-4 font-bold"><span>ID No</span><span>{{$verification_record->id_no }}</span></li>
                            <li class="flex justify-between gap-4"><span>Surname</span><span>{{$verification_record->last_name}}</span></li>
                            <li class="flex justify-between gap-4"><span>First Name</span><span>{{$verification_record->first_name}}</span></li>
                            <li class="flex justify-between gap-4"><span>Middle Name</span><span>{{$verification_record->middle_name}}</span></li>
                            <li class="flex justify-between gap-4"><span>Email</span><span>{{$verification_record->email}}</span></li>
                            <li class="flex justify-between gap-4"><span>Phone</span><span>{{$verification_record->phone}}</span></li>
                            <li class="flex justify-between gap-4"><span>Date of Birth</span><span>{{$verification_record->dob}}</span></li>
                            <li class="flex justify-between gap-4"><span>Gender</span><span>{{$verification_record->gender}}</span></li>
                            <li class="flex justify-between gap-4"><span>Marital Status</span><span class="uppercase">{{$verification_record->marital_status}}</span></li>
                        </ul>
                    </div>
                    <div>&nbsp;</div>
                    <div>
                        <img src="{{$verification_record->getFirstMediaUrl('doc')}}" alt="Uploaded file" class="w-full">
                    </div>
                </div>
            @else

                <form method="POST" wire:submit.prevent="verify" class="flex flex-col gap-4 w-full mt-4">
                    @csrf
                    @if($verifyType)
                        <div class="flex justify-between gap-4">
                            <h4 class="font-semibold text-lg">{{ $verificationTypes->find($verifyType)->name }}</h4>
                            <button type="button" wire:click.prevent="$set('verifyType', null)" class="btn btn-xs btn-secondary">Go Back</button>
                        </div>

                       <div class="max-w-lg space-y-4">
                           @switch($verifyType)
                               @case(1)
                                <p>Enter your NIN and provide a clear photo of your National ID Card.</p>
                               <x-floating-input id="nin" label="National Identification Number *" name="id_no" wrapperClass="w-full" wire:model.defer="id_no" type="text" placeholder="National Identification Number" />
                               @break
                               @case(2)
                               <x-floating-input id="passport_no" label="Passport Number *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Passport Number" required autofocus />
                               @break
                               @case(3)
                               <x-floating-input id="dv_license_no" label="Drivers License Number *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="Driver's License Number" required autofocus />
                               @break
                               @case(4)
                               <x-floating-input id="vin" label="VIN *" name="id_no" wrapperClass="" wire:model.defer="id_no" type="text" placeholder="VIN" required autofocus />
                               @break
                           @endswitch

                           <x-file-attachment wire:model="verifyDoc" :file="$verifyDoc" />

                           <x-button class="btn btn-primary btn-block" wire:loading.class="loading" wire:target="verify" wire:loading.attr="disabled">{{ __('Confirm') }}</x-button>
                       </div>


                    @else
                        <div class="flex justify-between gap-4">
                            <h4 class="font-semibold text-lg">Select a verification type to get started</h4>
{{--                            <button class="btn btn-xs btn-secondary">Go Back</button>--}}
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($verificationTypes as $vtype)
                                <div class="card card-body flex-row bg-white group group-hover:cursor-pointer cursor-pointer p-4 shadow-xl w-full rounded-3xl hover:shadow-lg dark:border-transparent transition-shadow">
                                    <label class="flex flex-row gap-4 items-center w-full cursor-pointer btn" for="verifyType-{{$vtype->id}}" wire:loading.class="loading" wire:target="verifyType">
                                    <span class="p-4 rounded-full bg-secondary-100">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                    </span>

                                        <div class="w-full">
                                            <div class="text-xs sm:text-sm font-semibold">{{$vtype->name}}</div>
                                            <p class="text-xs text-gray-600 font-thin">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias aperiam atque dolorem dolorum.
                                            </p>
                                        </div>
                                        <input id="verifyType-{{$vtype->id}}" type="radio" wire:model="verifyType" class="hidden" value="{{$vtype->id}}">
                                    </label>
                                </div>

                                {{--                        <option value="{{$vtype->id}}" @if($verification_record && $vtype->id==$verification_record->verification_type_id) selected @endif>{{$vtype->name}}</option>--}}
                            @endforeach
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
