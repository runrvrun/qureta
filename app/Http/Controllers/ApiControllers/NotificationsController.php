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
use DB;


class NotificationsController extends Controller {
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
  function getThread($id,$userLogin)
  {
    $data = DB::table('threads')->select('id','subject','created_at')->where('id',$id)->first()->get();
    foreach($data as $key=>$row)
    {
      
    }
  }
  public function getThreadList (Request $request)
  {
    $userLogin = $request->userLogin;
    $token = $request->token;
    $limit = isset($request->limit)? $request->limit:10;
    $offset = isset($request->offset)? $request->offset:0;
    if($this->checkToken($userLogin,$token))
    {
      $data = DB::table('participants')->select('id')->where('user_id',$userLogin)->groupBy('thread_id')->orderBy('updated_at')->limit($limit)->offset($offset)->get();
      return response()->json([
          'status' => 'success',
          'hasil' => $notif
        ]);
    }
  }

}
