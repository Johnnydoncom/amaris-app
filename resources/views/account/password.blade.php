<x-account-layout>
    <x-slot name="title">Change Password</x-slot>

    <div>
        <!-- start::Stats -->
        <div class="flex w-full justify-center">
           <div class="w-full sm:w-1/2">
            <h3 class="font-bold text-lg sm:text-xl">Change Password</h3>
            <div class="divider mt-0"></div>
               <form method="POST" action="{{ route('account.password.store') }}" class="">
               @csrf
               <!-- Old Password -->
                   <x-floating-input id="oldpassword" wrapperClass="mb-4" name="oldpassword" label="Old Password" type="password" placeholder="Old Password" required autocomplete="old-password" />
                   <!-- New Password -->
                   <x-floating-input id="password" wrapperClass="mb-4" name="password" label="New Password" type="password" placeholder="New Password" required autocomplete="new-password" />
                   <!-- New Password -->
                   <x-floating-input id="password_confirmation" wrapperClass="mb-4" name="password_confirmation" label="Confirm New Password" type="password" placeholder="Confirm New Password" required />

                   <x-button class="btn btn-primary btn-block">{{ __('Change Password') }}</x-button>

               </form>
               <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
        </div>
    </div>
</x-account-layout>
