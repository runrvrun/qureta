<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use Auth;
use Session;
use Hash;

class ChangePasswordController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function changeform() {
        return view('auth.passwords.change');
    }

    public function change(Request $request) {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed|min:8'
        ]);

        $user = User::find(Auth::user()->id);
        if(Hash::check($request->oldpassword, $user->password)) {
            $user->fill([
            'password' => Hash::make($request->newpassword)
        ])->save();
        } else {
            Session::flash('flash_message', 'Incorrect password');
            return view('auth.passwords.change');
        }

        return view('auth.passwords.changesuccess');
    }

}
