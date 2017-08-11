<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use \App\User;
use Hash;
use Mail;

class BlastResetPasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Blast Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | Controller untuk reset ALL user password dan email ke mereka password barunya.
      | Dipakai untuk live pertama kali qureta v3
      |
     */

    public function __construct() {
        
    }

    public function resetall() {
        $subject = 'Perubahan Password Login Qureta';
        //get all user
        $users = User::all();
        //$users = User::where('email','assyaukanie@yahoo.com')->orWhere('email','assyaukanie@gmail.com')->orWhere('email','runrvrun@gmail.com')->get();

        foreach ($users as $user) {
            $email = $user->email;

            //generate new password
            $newpassword = str_random(8);

            //reset user password            
            $user->fill([
                'password' => Hash::make($newpassword)
            ])->save();

            //send email to all user with new password
            Mail::send(['html' => 'auth.passwords.emailresetblastv3'], ['email' => $email, 'newpassword' => $newpassword], function($message) use ($email, $subject, $email) {
                $message->to($email, $email)->subject($subject);
            });
        }
                
        return view('auth.passwords.emailresetblastv3success');
    }

}
