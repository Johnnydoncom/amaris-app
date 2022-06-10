<?php

namespace App\Http\Controllers\Account;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Country;
//use App\Models\PaymentInformation;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
//use Bavix\Wallet\Internal\Service\DatabaseServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

// use Asantibanez\LivewireCharts\Facades\LivewireCharts;
// use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class AccountController extends Controller
{
    public function index(){

        auth()->user()->wallet->refreshBalance();

        return view('account.home',[
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('account.settings',[
            'user' => User::find(Auth::id()),
            'countries' => Country::get(['id','name']),
            'payment_information' => Auth::user()->payment_information,
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
        ]);

        $request->user()->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'gender' => $request->gender
        ]);
        return redirect()->back()->withSuccess('Account updated');
    }

    public function editPassword(){
        return view('account.password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => ['min:8','confirmed', Rules\Password::defaults()],
            'oldpassword' => ['required', new MatchOldPassword],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->withSuccess('Password updated');
    }

    public function storeBank(Request $request){
        // if(!$request->user()->hasRole(UserRole::AFFILIATE)){
        //     return redirect()->route('account.index');
        // }

        $request->validate([
            'bank_name' => ['required'],
            'bank_account_no' => ['required'],
            'bank_account_name' => ['required'],
            'country_id' => ['required']
        ]);

        if(!$paymentInformation = PaymentInformation::whereUserId($request->user()->id)->first()){
            $paymentInformation = new PaymentInformation();
        }
        $paymentInformation->bank_name = $request->bank_name;
        $paymentInformation->bank_account_no = $request->bank_account_no;
        $paymentInformation->bank_account_name = $request->bank_account_name;
        $paymentInformation->bank_swift_code = $request->bank_swift_code;
        $paymentInformation->bank_branch = $request->bank_branch;
        $paymentInformation->country_id = $request->country_id;
        $paymentInformation->user_id = $request->user()->id;
        $paymentInformation->save();

        return redirect()->back()->withSuccess('Payment information updated');
    }


    public function wishlist(Request $request){
        return view('account.wishlist.list',[
            'products' => $request->user()->wishlist->map(function ($wish){
                $wish->product = $wish->product;
                return $wish;
            }),
        ]);
    }

    public function destroyWishlist(Request $request, Wishlist $wishlist){
        $wishlist->delete();
        return redirect()->back()->withSuccess('Wishlist Deleted');
    }

}
