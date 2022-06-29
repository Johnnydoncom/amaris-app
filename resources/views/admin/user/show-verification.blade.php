<x-admin-layout>
    <x-slot name="title">{{ __('Show Verification') }}</x-slot>


    <div>

        <x-card x-data="{}" class="card bg-white">
            <div class="card-body">
                <h4 class="text-gray-900 text-xl leading-tight font-bold mb-2">Verification Data</h4>
                <hr>
                @if($verification->verification_type->slug == Str::slug(App\Enums\VerificationTypes::ADDRESS()))
                    <div class="grid grid-cols-1 sm:grid-cols-2 my-4 gap-4">
                        <div class="text-left">
                            <h5 class="text-gray-900 text-lg leading-tight font-semibold mb-2">Site Data</h5>
                            <table class="w-full whitespace-nowrap">
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Address</th>
                                    <td>{{$verification->user->address}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>City</th>
                                    <td>{{$verification->user->city}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>State</th>
                                    <td>{{$verification->user->state}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Country</th>
                                    <td>{{$verification->user->country ? $verification->user->country->name : ''}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Zipcode</th>
                                    <td>{{$verification->user->zipcode}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="">
                            <a href="{{$verification->getFirstMediaUrl('doc')}}" class="cursor-pointer">
                                <img src="{{$verification->getFirstMediaUrl('doc')}}" class="w-full" alt="Verification File Upload">
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 my-4 gap-4">
                        <div class="text-left">
                            <h5 class="text-gray-900 text-lg leading-tight font-semibold mb-2">Site Data</h5>
                            <table class="w-full whitespace-nowrap">
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Last Name</th>
                                    <td>{{$verification->user->last_name}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>First Name</th>
                                    <td>{{$verification->user->first_name}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Email</th>
                                    <td>{{$verification->user->email}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Phone</th>
                                    <td>{{$verification->user->phone}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="text-left">
                            <h5 class="text-gray-900 text-lg leading-tight font-semibold mb-2">API Data</h5>
                            <table class="w-full whitespace-nowrap">
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Last Name</th>
                                    <td>{{$verification->last_name}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>First Name</th>
                                    <td>{{$verification->first_name}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Email</th>
                                    <td>{{$verification->email}}</td>
                                </tr>
                                <tr class="hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                    <th>Phone</th>
                                    <td>{{$verification->phone}}</td>
                                </tr>
                            </table>

                            <div class="py-4">
                                <h6 class="text-gray-900 text-md leading-tight font-semibold mb-2">File Uploaded</h6>
                                <img src="{{$verification->getFirstMediaUrl('doc')}}" class="w-full" alt="Verification File Upload">
                            </div>
                        </div>
                    </div>
                @endif
                <hr>
                <div class="max-w-md my-6">
                    <form action="{{ route('admin.users.verifications.update',$verification->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="flex gap-4 items-center w-full">
                            <x-floating-select wrapperClass="w-full" label="Status" name="status">
                                <option value="pending">Pending</option>
                                <option value="verified">Verified</option>
                                <option value="unverified">Reject</option>
                            </x-floating-select>

                            <div>
                                <x-button class="btn btn-primary">Update</x-button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </x-card>
    </div>

</x-admin-layout>
