<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::get(['id','name']);
        return view('auth.register',compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//        return $request->all();
        $request->validate([
            'last_name' => ['required', 'string', 'max:50'],
            'first_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'min:11', 'unique:users,phone'],
            'gender' => ['required', 'string'],
            'dob' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'exists:countries,id']
        ]);

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->telephone,
            'gender' => $request->gender,
            'dob' => Carbon::parse($request->dob),
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'state' => $request->state,
            'country_id' => $request->country_id
        ]);

        $user->assignRole(UserRole::CUSTOMER());

        event(new Registered($user));

        Auth::login($user);

        // Referral
        if(Cookie::get('referral')){
            $referral = Cookie::get('referral');
            if ($ref = User::where('account_id', $referral)->first()) {
                $user->update([
                    'referrer_id' => $ref->id
                ]);
            }
            Cookie::queue(Cookie::forget('referral'));
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
