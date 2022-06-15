<div x-data="{showForm:@entangle('showForm')}">
    <div class="relative flex flex-col justify-center w-full bg-secondary-100">
        <div class="max-w-6xl w-full mx-auto p-4 sm:p-20 py-6 sm:py-12 text-center h-full pb-4">
            <h2 class="text-2xl sm:text-4xl font-bold leading-tight text-primary mb-4">
                {{ $cta ?? 'Have any question?' }}
            </h2>
            <h6 class="font-semibold">Fill in the form below to get your free proposal</h6>

            <div class="bg-slate-100 w-full">
                <div class="text-white bg-primary py-3">
                    <h4 class="font-semibold text-lg lg:text-xl">Or talk to an expert right now!</h4>
                    <h2 class="font-extrabold text-3xl sm:text-4xl">{{setting('site_phone_number')}}</h2>
                </div>
                <div class="flex items-center justify-center gap-4 p-2 h-full">
                    <div class="bg-white p-4 sm:p-8 w-full">
                        <form wire:submit.prevent="send" method="post" class="w-full sm:max-w-lg sm:mx-auto space-y-4 ">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="form-control">
                                    <x-label class="text-left">Name</x-label>
                                    <x-input label="Name" class="w-full" type="text" placeholder="" id="name" name="name" wire:model.defer="name" />
                                </div>

                                <div class="form-control">
                                    <x-label class="text-left">Email</x-label>
                                    <x-input label="Email" type="email" placeholder="" id="email" name="email" wire:model.defer="email" />
                                </div>
                            </div>
                            <div class="form-control">
                                <x-label class="text-left">Contact Phone</x-label>
                                <x-input label="Contact Phone" type="tel" placeholder="" id="phone" name="phone" wire:model.defer="phone" />
                            </div>
                            <div class="form-control">
                                <x-label class="text-left">Subject</x-label>
                                <x-input label="Subject" type="text" class="border" placeholder="" id="subject" name="subject" wire:model.defer="subject" />
                            </div>
                            <div class="form-control">
                                <x-label class="text-left">Your Message</x-label>
                                <x-textarea label="Your Message" class="border" placeholder="Your Message" id="message" name="message" wire:model.defer="message" />
                            </div>

                            <button class="btn btn-primary btn-lg btn-block" wire:loading.class="loading">Send Message</button>
                        </form>
                        @if(session('success'))
                            <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                                    {{session('success')}}
                                </div>
                                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                    @endif

                    <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
