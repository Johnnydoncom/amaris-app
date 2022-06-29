<div>
    <h3 class="font-bold text-lg sm:text-xl mt-5 sm:mb-4">Payment Information</h3>

    <x-card class="max-w-xl">

        @if($editing)
            <form method="POST" wire:submit.prevent="save" class="">
            @csrf
            <x-floating-input id="bank_name" wrapperClass="mb-4" wire:model.defer="bank_name" label="Bank Name" type="text" placeholder="Bank Name" required />

            <x-floating-input id="bank_account_no" wrapperClass="mb-4" wire:model.defer="bank_account_no" label="Bank Account Number" type="text" placeholder="Bank Account Number" required />

            <x-floating-input id="bank_account_name" wrapperClass="mb-4" wire:model.defer="bank_account_name" label="Bank Account Name" type="text" placeholder="Bank Account Name" required />

            <x-floating-input id="bank_swift_code" wrapperClass="mb-4" wire:model.defer="bank_swift_code" label="Bank Swift Code" type="text" placeholder="Bank Swift Code" />

            <x-floating-input id="bank_branch" wrapperClass="mb-4" wire:model.defer="bank_branch" label="Bank Branch" type="text" placeholder="Bank Branch" required />

            <x-floating-select id="country_id" label="Bank Country" wire:model.defer="country_id" wrapperClass="mb-4" placeholder="Bank Country" required>
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @if($payment_information && $payment_information->country_id===$country->id) selected @endif>{{ $country->name }}</option>
                @endforeach
            </x-floating-select>


            <x-button class="btn btn-secondary btn-block" wire:loading.class="loading">{{ __('Update') }}</x-button>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <x-flash-messages />
        </form>
        @else
            <div class="flex gap-2 flex-row">
                <svg class="w-6 h-6 flex-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                <div>
                    <div class="flex justify-between items-center gap-2">
                        <h3 class="font-semibold">{{$payment_information->bank_name}}</h3>
                        <span class="text-xs text-gray-400">added {{$payment_information->created_at->format('m/Y')}}</span>
                    </div>
                    <div>
                        <p class="text-gray-400">{{$payment_information->bank_account_name}}</p>
                        <p class="text-gray-400">{{$payment_information->bank_account_no}}</p>
                    </div>
                </div>
            </div>
            <div class="divider my-0"></div>
            <div class="text-center">
                <button class="text-secondary" wire:click.prevent="$set('editing', true)" wire:loading.class="loading">Edit</button>
            </div>
        @endif
    </x-card>
</div>
