<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon;
use Session;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function authenticate(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            if (Auth::user()->banned_until < Carbon::now()){
                return redirect()->intended('/');                
            }else{
                Auth::logout(); 
                Session::flash('alert-type','alert-danger');
                Session::flash('flash_message','Login gagal. Akses Anda diblokir.');               
                return redirect('login');
            }
        }else{
                Session::flash('alert-type','alert-danger');
                Session::flash('flash_message','Username atau password salah'); 
            return redirect('login');
        }
    }
}
