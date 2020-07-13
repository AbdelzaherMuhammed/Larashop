<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    public function MyAccount()
    {
        return view('myaccount.index');
    }

    public function myAccountLink($link)
    {
        return view('myaccount.index' , compact('link'));
    }

    public function trackOrder($id)
    {
        $records = Order::where('id' , $id)->get();

        return view('myaccount.track' , compact('records'));
    }

    public function OrderDetails($id)
    {
        return view('myaccount.order-details');
    }

    public function saveAddress(Request $request)
    {
        $rules = [
            'name' => 'required|max:35',
            'phone' => 'required|numeric|min:11',
            'city' => 'required|min:5|max:25',
            'country' => 'required',
        ];

        $this->validate($request, $rules);

        $user = auth()->user();

        $user->update($request->all());
        if ($user){
            flash()->success('Profile updated successfully !');
            return back();
        }else {
            flash()->error('Error happened , please try again');
        }

    }

    public function updatePassword(Request $request)
    {

        $rules = [
            'current_password' => 'required',
            'new_password'  => 'required|confirmed'
        ];

        $this->validate($request, $rules);

        $user = auth()->user();

        if (Hash::check($request->input('current_password') , $user->password))
        {
            $user->password = bcrypt($request->input('new_password'));
            $user->save();
            if ($user){
                flash()->success('Password updated successfully !');
                return back();
            }else {
                flash()->error('Error happened , please try again');
                return back();
            }
        }else{
            flash()->error('password isn\'t correct');
            return back();
        }


    }
}
