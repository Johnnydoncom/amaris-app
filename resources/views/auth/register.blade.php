<x-guest-layout>
    <x-auth-card>

        <div class="text-center space-y-6" >
            <h2 class="font-semibold text-2xl sm:text-3xl 2xl:text-4xl text-center">Create an account for free
                and place your first order.</h2>
            <p class="text-gray-600 text-sm sm:text-lg">Get bulk order pricing on popular gift cards, including custom Visa & Mastercard reward cards featuring your logo.</p>

        </div>

        <form method="POST" class="mt-10 sm:mt-0 space-y-4 sm:space-y-6" action="{{ route('register') }}">
            @csrf

            <x-floating-input id="last_name" :label="__('Last Name')" name="last_name" wrapperClass="" type="text" :placeholder="__('Last Name')" :value="old('last_name')" required autofocus />

            <x-floating-input id="first_name" :label="__('First Name')" name="first_name" wrapperClass="" type="text" :placeholder="__('First Name')" :value="old('first_name')" required autofocus />

            <!-- Email Address -->
            <x-floating-input id="email" label="Email" name="email" wrapperClass="" type="email" placeholder="Email" :value="old('email')" required autofocus />

            <x-floating-input id="phone" :label="__('Phone Number')" name="phone" wrapperClass="" type="text" :placeholder="__('Phone Number')" :value="old('phone')" required />

            <!-- Password -->
            <x-floating-input id="password" wrapperClass="" name="password" label="Password" type="password" placeholder="Password" required autocomplete="new-password" />


            <div class="flex items-center mt-4">
                <x-button class="btn-primary btn-block">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="text-center space-y-6 mt-10 sm:mt-20 mb-4">
            @if(Route::has('login'))
                <a class="text-center link link-primary link-hover" href="{{ route('login') }}">
                    {{ __("Already have an account? Sign In") }}
                </a>
            @endif

            <p>For help, <a class="link" href="mailto:example@example.com">email us</a> or call (234) 803 130-4346.</p>
        </div>
    </x-auth-card>
</x-guest-layout>
