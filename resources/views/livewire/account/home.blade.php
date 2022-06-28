<div x-data="{}">
    <div class="card rounded-none">
        <div class="card-body flex px-0 py-2 sm:py-1 flex-row items-center gap-2 sm:gap-4 relative">
            <div class="avatar online">
                <label class="w-16 sm:w-24 rounded-full leading-tight bg-white hover:bg-gray-100 cursor-pointer inline-flex items-center transition duration-500 ease-in-out group overflow-hidden group relative" for="avatar-input">
                    <img src="{{ Auth::user()->avatar_url }}" />
                    <input id="avatar-input" type="file" name="avatar" wire:model="avatar" class="hidden" style="display: none">
                    <div wire:loading.remove class="hidden group-hover:block absolute bottom-0 inset-x-0 mx-auto bg-primary bg-opacity-70">
                        <x-cui-cil-camera class="w-4 h-4 inset-x-0 mx-auto inset-y-0 my-2 text-white" />
                    </div>


                    <div wire:loading.flex wire:target="avatar" wire:loading.class="absolute inset-x-0 w-auto mx-auto ">
                        <div class="select-none text-sm text-primary flex flex-1 items-center justify-center text-center p-4 flex-1">
                            <svg class="animate-spin h-4 w-4 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </label>
            </div>

            <div class="grid grid-cols-3 gap-2 sm:gap-4 w-full">
                <div class="col-span-2">
                    <h2 class="font-semibold text-lg sm:text-2xl">{{Auth::user()->name}}</h2>
                    <p class="font-normal text-sm text-gray-400">Account ID: {{Auth::user()->account_id}}</p>
                </div>
            </div>

            <div class="text-right flex justify-end float-right items-center absolute top-0 right-0">
                <div class="flex gap-2 items-center text-xs sm:text-sm">
                    @if(Auth::user()->verified)
                        <x-cui-cil-check-circle class="w-4 h-4 sm:w-6 sm:h-6 text-success"/>
                        <h5 class="font-semibold">Status:</h5>
                        <h4 class="">Verified</h4>
                    @else
                        <x-cui-cil-warning class="w-4 h-4 sm:w-6 sm:h-6 text-warning"/>
                        <h5 class="font-semibold">Status:</h5>
                        <h4 class=""><a href="{{route('account.verification.index')}}" class="underline">Unverified</a></h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="divider my-0"></div>

    <div class="card rounded-none">
        <div class="card-body p-1 sm:p-auto">
            <h2 class="font-semibold text-xl sm:text-2xl py-4">Account Information</h2>
            <form method="POST" action="{{ route('account.settings.store') }}" >
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                    @csrf
                    <x-floating-input id="last_name" label="Last Name *" name="last_name" wire:model.defer="last_name" wrapperClass="" type="text" placeholder="Last Name *" :value="$user->last_name" readonly required autofocus />

                    <x-floating-input id="first_name" label="First Name *" name="first_name" wire:model.defer="first_name" wrapperClass="" type="text" placeholder="First Name" :value="$user->first_name" readonly required autofocus />

                    <!-- Email Address -->
                    <x-floating-input id="email" label="Email *" name="email" wrapperClass="" wire:model.defer="email" type="email" placeholder="Email" :value="$user->email" readonly autofocus />

                    <x-floating-input id="phone" label="Phone Number *" name="phone" wrapperClass="" wire:model.defer="phone" type="text" placeholder="Phone Number" :value="$user->phone" required />

                    <x-floating-select id="gender" label="Gender" name="gender" wrapperClass="" wire:model.defer="gender" placeholder="Gender" :value="$user->gender">
                        <option value="">Select</option>
                        <option value="Male" @if($user->gender=='Male') selected @endif>Male</option>
                        <option value="Female" @if($user->gender=='Female') selected @endif>Female</option>
                    </x-floating-select>

                    <x-floating-date id="dob" wire:model="dob" :error="$errors->first('dob')" label="Date of Birth *" name="dob" wrapperClass="" type="date" placeholder="Date of Birth" :value="$user->dob" />

                    <x-floating-input id="address" label="Address" wire:model.defer="address" name="address" wrapperClass="" type="text" :placeholder="__('Address')" :value="$user->address" />

                    <x-floating-input id="city" label="City" name="city" wrapperClass="" wire:model.defer="city" type="text" :placeholder="__('City')" :value="$user->city" />

                    <x-floating-input id="zip" label="Zipcode" name="zip" wrapperClass="" wire:model.defer="zipcode" type="text" :placeholder="__('Zipcode')" :value="$user->zip" />

                    <x-floating-select id="country" label="Country" name="country" wrapperClass="" wire:model.defer="country" :placeholder="__('Country')">
                        <option value="">Select</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}" @if($user->country_id==$country->id) selected @endif>{{$country->name}}</option>
                        @endforeach
                    </x-floating-select>

                    <div class="col-span-2">
                        <x-button class="btn btn-primary btn-block">{{ __('Update Account') }}</x-button>
                    </div>
                </div>
            </form>
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
