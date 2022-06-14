<x-admin-layout>
    <div>
        <h3 class="text-2xl font-medium text-gray-700">General Settings</h3>

        <div>
            <p class="my-2 text-sm text-gray-600">
                This information is used to configure your app so be careful with it.
            </p>
            <div class="md:grid md:grid-cols-3 md:gap-6">

                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="mb-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <x-floating-input id="site_name" label="Site Name" value="{{setting('site_name')}}" type="text" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div class="form-control">
                                        <x-floating-input id="site_email" label="Site Email" value="{{setting('site_email')}}" type="text" />
                                    </div>
                                    <div class="form-control">
                                        <x-floating-input id="site_phone" label="Site Phone" value="{{setting('site_phone')}}" type="text" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-6 mb-6">
                                    <div class="form-control">
                                        <x-floating-select id="site_currency_name" label="Site Currency Name" type="text">
                                            @foreach($countries as $country)
                                            <option value="{{$country->currency}}" @if(setting('site_currency_name') == $country->currency) selected @endif>{{$country->name.' '.$country->currency}}</option>
                                            @endforeach
                                        </x-floating-select>
                                    </div>
                                    <div class="form-control">
                                        <x-floating-input id="site_currency_code" label="Site Currency Code" value="{{setting('site_currency_code')}}" type="text" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <x-label for="site_logo" value="Site Logo" class="" />

                                        <div class="mt-1 flex items-center">
                                          <span class="inline-block h-12 overflow-hidden bg-gray-100">
                                              <img class="h-full w-full text-gray-300" src="{{ site_logo() }}" alt="Site Logo">
                                          </span>
                                            <label class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  tracking-wide cursor-pointer">Change
                                                <input type="file" class="hidden" name="logoUpload" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="">

                                    </div>
                                </div>

                                <div class="mb-6">
                                    <x-floating-textarea label="Site Description" id="site_description" name="site_description" rows="3">{!! setting('site_description') !!}</x-floating-textarea>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Brief description for your site.
                                    </p>
                                </div>


                                <h3 class="font-semibold text-xl mt-6">PayStack Settings</h3>
                                <div class="divider my-0"></div>
                                <div class="grid grid-cols-6 gap-6 mt-2">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input type="text" name="paystack_secret" id="paystack_secret" value="{{setting('paystack_secret')}}" label="Secret Key" placeholder=""/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input label="Publishable Key" type="text" name="paystack_key" id="paystack_key" value="{{setting('paystack_key')}}" placeholder=""/>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-select label="Mode" name="paystack_mode" class="w-full">
                                            <option value="test" @if(setting('paystack_mode')=='test') selected @endif>Test</option>
                                            <option value="live" @if(setting('paystack_mode')=='live') selected @endif>Live</option>
                                        </x-floating-select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-select label="Status" name="paystack_active" class="w-full">
                                            <option value="0" @if(setting('paystack_active')==0) selected @endif>Disabled</option>
                                            <option value="1" @if(setting('paystack_active')==1) selected @endif>Active</option>
                                        </x-floating-select>
                                    </div>
                                </div>

                                <h3 class="font-semibold text-xl mt-6">Stripe Settings</h3>
                                <div class="divider my-0"></div>
                                <div class="grid grid-cols-6 gap-6 mt-2">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input type="text" label="Stripe Secret" name="stripe_secret" id="stripe_secret" value="{{setting('stripe_secret')}}" placeholder=""/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input label="Stripe Key" type="text" name="stripe_key" id="stripe_key" value="{{setting('stripe_key')}}" placeholder=""/>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-select label="Status" id="stripe_active" name="stripe_active" class="w-full">
                                            <option value="0" @if(setting('stripe_active')==0) selected @endif>Disabled</option>
                                            <option value="1" @if(setting('stripe_active')==1) selected @endif>Active</option>
                                        </x-floating-select>
                                    </div>
                                </div>

                                <h3 class="font-semibold text-xl mt-6">Verification API</h3>
                                <div class="divider my-0"></div>
                                <div class="grid grid-cols-6 gap-6 mt-2">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input type="text" label="VerifyAfrica User ID" name="verifyafrica_userid" id="verifyafrica_userid" value="{{setting('verifyafrica_userid')}}" placeholder=""/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input label="VerifyAfrica Drivers License Key" type="text" name="verifyafrica_dvl_key" id="verifyafrica_dvl_key" value="{{setting('verifyafrica_dvl_key')}}" placeholder=""/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input label="VerifyAfrica NIN Key" type="text" name="verifyafrica_nin_key" id="verifyafrica_nin_key" value="{{setting('verifyafrica_nin_key')}}" placeholder=""/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input label="VerifyAfrica VotersCard Key" type="text" name="verifyafrica_voters_key" id="verifyafrica_voters_key" value="{{setting('verifyafrica_voters_key')}}" placeholder=""/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input label="VerifyAfrica Intl Passport Key" type="text" name="verifyafrica_passport_key" id="verifyafrica_passport_key" value="{{setting('verifyafrica_passport_key')}}" placeholder=""/>
                                    </div>
                                </div>

                                <h3 class="font-semibold text-xl mt-6">Twilio API</h3>
                                <div class="divider my-0"></div>
                                <div class="grid grid-cols-6 gap-6 mt-2">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input type="text" label="Twilio Account SID" name="twilio_sid" id="twilio_sid" value="{{setting('twilio_sid', env('TWILIO_ACCOUNT_SID'))}}" placeholder=""/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-floating-input label="Twilio Auth Token" type="text" name="twilio_auth_token" id="twilio_auth_token" value="{{setting('twilio_auth_token', env('TWILIO_AUTH_TOKEN'))}}" placeholder=""/>
                                    </div>
                                </div>

                                <h3 class="font-semibold text-xl mt-6">Exchange API</h3>
                                <div class="divider my-0"></div>
                                <div class="form-control">
                                    <x-floating-input type="text" label="Open Exchange Rate" name="open_exchange_api" id="open_exchange_api" value="{{setting('open_exchange_api', env('OPEN_EXCHANGE_RATE_KEY'))}}" placeholder=""/>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <x-button type="submit" class="btn btn-secondary">
                                    Save
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <!--                        <h3 class="text-lg font-medium leading-6 text-gray-900">Site Settings</h3>-->
                        <!--                        <p class="mt-1 text-sm text-gray-600">-->
                        <!--                            This information will be displayed publicly so be careful what you share.-->
                        <!--                        </p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
