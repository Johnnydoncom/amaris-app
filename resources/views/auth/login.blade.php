<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="h-20 fill-current text-gray-500" />
            </a>
        </x-slot>


        <div class="text-center space-y-6" >
            <h2 class="font-semibold text-2xl sm:text-3xl 2xl:text-4xl text-center text-primary">Login</h2>
            <p class="text-gray-600 text-sm sm:text-lg">Login to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="mt-10 space-y-4 sm:space-y-6">
            @csrf
            <!-- Email Address -->
                <x-floating-input id="email" label="Email" name="email" wrapperClass="" type="email" placeholder="Email" :value="old('email')" required autofocus />

               <div>
                   <!-- Password -->
                   <x-floating-input id="password" wrapperClass="" name="password" label="Password" type="password" placeholder="Password" required autocomplete="new-password" />

                   <!-- Remember Me -->
                   <div class="flex justify-between gap-2 sm:gap-4 mt-2">
                       <x-checkbox id="remember_me" name="remember" label="{{ __('Remember me') }}" />
                       @if (Route::has('password.request'))
                           <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                               {{ __('Forgot password?') }}
                           </a>
                       @endif
                   </div>
               </div>

                <div class="flex items-center mt-4">
                    <x-button class="btn-primary btn-block">
                        {{ __('Log in') }}
                    </x-button>
                </div>
        </form>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="text-center space-y-6 mt-10 mb-4">
        @if(Route::has('register'))
            <a class="text-center link link-primary link-hover" href="{{ route('register') }}">
                {{ __("Don't have an account? Sign Up") }}
            </a>
        @endif

            <p>For help, <a class="link" href="mailto:{{setting('site_email', 'contact@amaris.ng')}}">email us</a> or call {{setting('site_phone_number', '(234) 803 130-4346')}}.</p>
        </div>
    </x-auth-card>
</x-guest-layout>
