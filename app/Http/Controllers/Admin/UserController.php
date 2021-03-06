<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Enums\VerificationTypes;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVerification;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $roles = $roles->reject(function ($role, $key) {
            return $role->name == UserRole::SUPERADMIN;
        });
        return view('admin.user.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
            'role' => 'required'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone  = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = Carbon::now();
        $user->save();
        // Role
        $user->assignRole($request->role);

        event(new Registered($user));

        return redirect()->route('admin.users.index')->withSuccess('User Account Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $roles = $roles->reject(function ($role, $key) {
            return $role->name == UserRole::SUPERADMIN;
        });
        return view('admin.user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required'
        ]);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone  = $request->phone;
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        // Role
        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->withSuccess('User Account Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function verifications(){
        return view('admin.user.verifications',[
            'verifications' => UserVerification::whereStatus('pending')->paginate()
        ]);
    }

    public function showVerification(UserVerification $userVerification){
        return view('admin.user.show-verification',[
            'verification' => $userVerification
        ]);
    }

    public function verificationAction(Request $request, UserVerification $userVerification){
       $request->validate(['status'=>'required']);
       $userVerification->update(['status'=>$request->status]);

       if($request->status == 'verified'){

           if($userVerification->verification_type->slug == Str::slug(VerificationTypes::ADDRESS())){
               $userVerification->user->update(['address_verified'=>true]);
           }else{
               $userVerification->user->update(['verified'=>true]);
           }
        }
        return redirect()->route('admin.users.verifications.index')->withSuccess('Record Updated');
    }

}
