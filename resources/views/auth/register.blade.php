<x-guest-layout>
    <x-auth-card>

        <div class="text-center space-y-6" >
            <h2 class="font-semibold text-2xl sm:text-3xl 2xl:text-4xl text-center">Create your account</h2>

        </div>

        <form method="POST" class="mt-10 space-y-4 sm:space-y-6" action="{{ route('register') }}">
            @csrf

            <x-floating-input id="last_name" :label="__('Last Name')" name="last_name" wrapperClass="" type="text" :placeholder="__('Last Name')" :value="old('last_name')" required autofocus />

            <x-floating-input id="first_name" :label="__('First Name')" name="first_name" wrapperClass="" type="text" :placeholder="__('First Name')" :value="old('first_name')" required autofocus />

            <!-- Email Address -->
            <x-floating-input id="email" label="Email" name="email" wrapperClass="" type="email" placeholder="Email" :value="old('email')" required autofocus />

            <x-floating-input id="phone" :label="__('Phone Number')" name="phone" wrapperClass="" type="text" :placeholder="__('Phone Number')" :value="old('phone')" required />

            <x-floating-select id="gender" label="Gender" name="gender" wrapperClass="" placeholder="Gender">
                <option value="">Select</option>
                <option value="Male" @if(old('gender') =='Male') selected @endif>Male</option>
                <option value="Female" @if(old('gender')=='Female') selected @endif>Female</option>
            </x-floating-select>

            <x-floating-date-two id="dob" wire:model="dob" label="Date of Birth *" name="dob" wrapperClass="" type="date" placeholder="Date of Birth" value="" />

            <x-floating-input id="address" :label="__('Address')" name="address" wrapperClass="" type="text" :placeholder="__('Address')" :value="old('address')" required />

            <x-floating-input id="state" :label="__('State')" name="state" wrapperClass="" type="text" :placeholder="__('State')" :value="old('state')" required />
            <x-floating-select id="country_id" label="Country" name="country_id" wrapperClass="mb-4" placeholder="Country" required>
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                @endforeach
            </x-floating-select>

            <!-- Password -->
            <x-floating-input id="password" wrapperClass="" name="password" label="Password" type="password" placeholder="Password" required autocomplete="new-password" />
            <x-floating-input id="password_confirmation" wrapperClass="" name="password_confirmation" label="Password Confirmation" type="password" placeholder="Password" required />


            <div class="flex items-center mt-4">
                <x-button class="btn-primary btn-block">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="text-center space-y-6 mt-10 mb-4">
            @if(Route::has('login'))
                <a class="text-center link link-primary link-hover" href="{{ route('login') }}">
                    {{ __("Already have an account? Sign In") }}
                </a>
            @endif

            <p>For help, <a class="link" href="mailto:{{setting('site_email', 'contact@amaris.ng')}}">email us</a> or call {{setting('site_phone_number', '(234) 803 130-4346')}}.</p>
        </div>
    </x-auth-card>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    @endpush
    @push('scripts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
        <script>
            const phoneInputField = document.querySelector("#phone");
            const phoneInput = window.intlTelInput(phoneInputField, {
                initialCountry: "auto",
                hiddenInput:"telephone",
                nationalMode: false,
                // formatOnDisplay: true,
                utilsScript:
                    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            phoneInputField.addEventListener("change", function() {
                // if (typeof intlTelInputUtils !== 'undefined') { // utils are lazy loaded, so must check
                    var currentText = phoneInput.getNumber(intlTelInputUtils.numberFormat.E164);
                    if (typeof currentText === 'string') { // sometimes the currentText is an object :)
                        phoneInput.setNumber(currentText); // will autoformat because of formatOnDisplay=true
                    }
                // }
            });
        </script>
    @endpush
</x-guest-layout>
