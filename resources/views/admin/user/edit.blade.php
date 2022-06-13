<x-admin-layout>
    <div class="max-w-xl mx-auto">
        <x-card class="card bg-white">
            <div class="card-body">
                <h2 class="card-title font-semibold text-2xl mb-6">Edit Account</h2>
                <form method="post" enctype="multipart/form-data" action="{{route('admin.users.update', $user->id)}}">
                    @csrf
                    @method("PATCH")
                    <div class="form-control mb-3">
                        <x-floating-input label="Last Name" type="text" placeholder="Last Name" value="{{$user->last_name}}" name="last_name" required autofocus />
                    </div>
                    <div class="form-control mb-3">
                        <x-floating-input label="First Name" type="text" placeholder="First Name" value="{{$user->first_name}}" name="first_name" required />
                    </div>
                    <div class="form-control mb-3">
                        <x-floating-input label="Email" type="email" placeholder="Email Address" value="{{$user->email}}" name="email" required />
                    </div>
                    <div class="form-control mb-3">
                        <x-floating-input label="Phone" type="tel" placeholder="Phone" name="phone" value="{{$user->phone}}" autofocus />
                    </div>
                    <div class="form-control mb-3">
                        <x-floating-input label="Password (Optional)" type="password" placeholder="Password" name="password" />
                    </div>
                    <div class="form-control mb-3">
                        <x-floating-select label="User Role" class="w-full mb-2" name="role">
                            <option disabled="disabled" selected="selected">Choose Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" @if(in_array($role->name, $user->roles()->pluck('name')->toArray())) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </x-floating-select>
                    </div>

                    <div class="bg-gray-50 py-3 flex justify-center space-x-3">
                        <x-button type="submit" class="btn-primary btn-block">Update Account</x-button>
                    </div>

                </form>
            </div>
        </x-card>
    </div>
</x-admin-layout>
