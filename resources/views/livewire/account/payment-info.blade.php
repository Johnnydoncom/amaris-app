<div>
    <x-card class="max-w-xl">
        <h3 class="font-bold text-lg sm:text-xl mt-5 sm:mt-0">Bank Information</h3>
        <div class="divider mt-0"></div>
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
    </x-card>
</div>
