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

    public function login (Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->pass])) {
            // Authentication passed...
            if (Auth::user()->banned_until < Carbon::now()){
                $token = bin2hex(random_bytes(10));
                \App\User::where('id', Auth::user()->id)->update(['api_token' => $token]);
                return response()->json([
                    'status' => 'success',
                    'token' => $token,
                    'data' => ['id' => Auth::user()->id]
                ]);
            }

            else{
                Auth::logout();
                return response()->json([
                    'status' => 'fail',
                    'data' => ['message' => 'Login failed. User banned.']
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
              'data' => ['message' => 'Login failed. Invalid username or password.']
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

        $socialaccount = SocialAccount::select('user_id')->where('provider_user_id',$request->user_id)->where('provider',$providerName)->first();

        if($socialaccount){
          return response()->json([
            'status' => 'success',
            'token' => bin2hex(random_bytes(10)),
            'data' => ['id' => Auth::user()->id]
          ]);
        }else{
          //register new social user
          $account = new SocialAccount([
              'provider_user_id' => $request->user_id,
              'provider' => $providerName
          ]);

          $user = User::whereEmail($request->email)->first();

          if (!$user) {

              $user = User::create([
                          'username' => str_replace('.','_',str_replace('@','_',$request->userName)),
                          'email' => $request->email,
                          'name' => $request->realName,
                          'user_image' => $request->avatar,
                          'password' => $providerName,
              ]);
          }

          $account->user()->associate($user);
          $account->save();

          $token = bin2hex(random_bytes(10));
          \App\User::where('id', Auth::user()->id)->update(['api_token' => $token]);
          return response()->json([
            'status' => 'success',
            'token' => $token,
            'data' => ['id' => Auth::user()->id]
          ]);
        }
    }

    public function userRegister (Request $request)
    {
      $user = User::create([
          'name' => $data['name'],
          'username' => $data['username'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
      ]);
      if($user){
        User_metum::create([
          'user_id' => $user->id,
          'meta_name' => 'profesi',
          'meta_value' => $data['profesi'],
        ]);

        $token = bin2hex(random_bytes(10));
        \App\User::where('id', Auth::user()->id)->update(['api_token' => $token]);
        return response()->json([
          'status' => 'success',
          'token' => $token,
          'data' => ['id' => $user->id, 'username' => $user->username]
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Failed to create user. Username or email already taken.']
        ]);
      }

    }
}
