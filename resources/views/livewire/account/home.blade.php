<div x-data="{}">
    <div class="card rounded-none">
        <div class="card-body flex px-0 py-2 sm:py-1 flex-row items-center gap-4">
            <div class="avatar online">
                <div class="w-16 sm:w-24 rounded-full">
                    <img src="{{ Auth::user()->avatar_url }}" />
                </div>
            </div>
            <div>
                <h2 class="font-semibold text-lg sm:text-2xl">{{Auth::user()->name}}</h2>
                <p class="font-normal text-sm text-gray-400">Account ID: {{Auth::user()->account_id}}</p>
                <label for="avatar-input" class="btn btn-primary btn-xs capitalize" wire:loading.class="loading" wire:target="avatar">Upload Image
                    <input id="avatar-input" type="file" name="avatar" wire:model="avatar" class="hidden" style="display: none">
                </label>
            </div>
        </div>
    </div>
    <div class="divider my-0"></div>

    <div class="card rounded-none">
        <div class="card-body p-1 sm:p-auto">
            <h2 class="font-semibold text-xl sm:text-2xl py-4">Account Information</h2>
            <form method="POST" action="{{ route('account.settings.store') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @csrf
                <x-floating-input id="last_name" label="Last Name *" name="last_name" wire:model.defer="last_name" wrapperClass="w-full" type="text" placeholder="Last Name *" :value="$user->last_name" readonly required autofocus />

                <x-floating-input id="first_name" label="First Name *" name="first_name" wire:model.defer="first_name" wrapperClass="w-full" type="text" placeholder="First Name" :value="$user->first_name" readonly required autofocus />

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
