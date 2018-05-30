<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon;
use Session;
use SocialAccount;
use App\Log;

class AuthController extends Controller {
  /*
  / api response standard: https://labs.omniti.com/labs/jsend
  / {
  /    status : "success",
  /    data : {
  /        "post" : { "id" : 1, "title" : "A blog post", "body" : "Some useful content" }
  /     }
  /}
  /{
  /    "status" : "fail",
  /    "data" : { "title" : "A title is required" }
  /}
  */

use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function checkToken ($userLogin,$token)
  {
    $user = \App\User::where('id', $userLogin)->where(['api_token' => $token])->first();
    if($user){
      return true;
    }
    else
    {
      return false;
    }
  }
    public function login (Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            if (Auth::user()->banned_until < Carbon::now()){
                $token = bin2hex(random_bytes(10));
                \App\User::where('id', Auth::user()->id)->update(['api_token' => $token]);
                return response()->json([
                    'sukses' => true,
                    'hasil' => [
                      'id' => Auth::user()->id,
                      'token' => $token,
                      'sukses' => true
                    ]
                ]);
            }
            else{
                Auth::logout();
                return response()->json([
                    'sukses' => false,
                    'hasil' => ['message' => 'Login failed. User banned.','sukses' => false]
                ]);
            }
             $log = Log::create([
            'username' => $data['email'],
            'activity' => 'Login',
            'time' => Carbon::now(),
            ]);
        }
        else{
            return response()->json([
              'status' => 'fail',
              'hasil' => ['message' => 'Login failed. Invalid username or password.']
            ]);
        }
    }

    public function socialLogin (Request $request)
    {
        switch($request->provider):
            case 'gmail':
              $providerName = 'GMailProvider';
              break;
            case 'facebook':
              $providerName = 'FacebookProvider';
              break;
            case 'twitter':
              $providerName = 'TwitterProvider';
              break;
            default:
              $providerName = 'FacebookProvider';
              break;
        endswitch;

        $socialaccount =  \App\SocialAccount::select('user_id')->where('provider_user_id',$request->userLogin)->where('provider',$providerName)->first();

        if($socialaccount){
          return response()->json([
            'status' => 'success',
            'hasil' => [
            	'id' =>  \App\Auth::user()->id,
            	'token' => bin2hex(random_bytes(10)),
            	'sukses' => true
            ]
          ]);
        }else{
          //register new social user
          $account = new SocialAccount([
              'provider_user_id' => $request->userLogin,
              'provider' => $providerName
          ]);

          $user =  \App\User::whereEmail($request->email)->first();

          if (!$user) {

              $user =  \App\User::create([
                          'username' => str_replace('.','_',str_replace('@','_',$request->username)),
                          'email' => $request->email,
                          'name' => $request->realName,
                          'user_image' => $request->avatar,
                          'password' => $providerName,
              ]);
          }

          $account->user()->associate($user);
          $account->save();
          $token = bin2hex(random_bytes(10));
          \App\User::where('id',  \App\Auth::user()->id)->update(['api_token' => $token]);
          return response()->json([
            'status' => 'success',
            'hasil' => [
            	'id' =>  \App\Auth::user()->id,
            	'token' => $token,
            	'sukses' => true
            ]
          ]);
        }
    }
    public function refreshToken (Request $request)
    {
      $userLogin = $request->userLogin;
      $token = $request->token;
      if($this->checkToken($userLogin,$token))
      {
        $token = bin2hex(openssl_random_pseudo_bytes(10));
        \App\User::where('id', $userLogin)->update(['api_token' => $token]);
        return response()->json([
          'status' => 'success',
          'hasil' => ['userLogin' => $userLogin,'token' => $token]
        ]);
      }
    }
    public function userRegister (Request $request)
    {
      $email = \App\User::where('email',$request->email)->get();
      $username = \App\User::where('username',$request->userName)->get();
      if($email->count()==0)
      {
        $user = \App\User::create([
          'name' => $request->realName,
          'username' => $request->userName,
          'email' => $request->email,
          'password' => bcrypt($request->pass),
        ]);
        if($user){
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'profesi',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'tanggallahir',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'tempatlahir',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'twitter',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'website',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'phone_number',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'short_bio',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'email',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'kota',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'linkedin',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'minat',
            'meta_value' => '',
          ]);
          \App\User_metum::create([
            'user_id' => $user->id,
            'meta_name' => 'pendidikan',
            'meta_value' => '',
          ]);
          $token = bin2hex(random_bytes(10));
          \App\User::where('id', $user->id)->update(['api_token' => $token]);
          return response()->json([
            'status' => 'success',
            'hasil' => ['id' => $user->id, 'username' => $user->username,'token' => $token]
          ]);
        }else{
          return response()->json([
            'status' => 'fail',
            'hasil' => ['message' => 'Failed to create user. Username or email already taken.']
          ]);
        }
      }
      elseif($username->count()==0)
      {
        return response()->json([
          'status' => 'fail',
          'hasil' => ['username_check' => false]
        ]);
      }
      else
      {
        return response()->json([
          'status' => 'fail',
          'hasil' => ['email_check' => false,'username_check' => false]
        ]);
      }
    }
    public function changePass (Request $request)
    {
      $userLogin = $request->userLogin;
      $pass = $request->pass;
      $pass = bcrypt($pass);
      \App\User::where('id', $userLogin)->update(['password' => $pass]);
      return response()->json([
        'status' => 'success',
        'hasil' => true
      ]);
    }
}
