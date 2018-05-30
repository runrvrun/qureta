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


class MessagesController extends Controller {
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
  public function getUsername ($id)
  {
    $user = \App\User::select('username')->where('id', $request->n)->first();
    return $user->username;
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
  public function getUserImage (Request $request)
  {
    $user = \App\User::select('user_image')->where('id', $request->n)->first();
    $userImage = parse_url($user->user_image);
    if (empty($userImage['scheme'])) {
      return "http://qureta.com/uploads/avatar/".$user->user_image;
    }
    else
    {
      return $user->user_image;
    }
  }
  public function getThreadInfo ($id)
  {
    $thread = DB::table('participants')->select('user_id')->where('thread_id',$id)->get();
    foreach($thread as $key=>$row)
    {
      $data[$key]['user'] = $this->getUsername($thread->user_id);
      $data[$key]['image'] = $this->getUserImage($thread->user_id);
    }
    return $data;
  }

  public function getThreadList (Request $request)
  {
    $userLogin = $request->userLogin;
    $token = $request->token;
    if($this->checkToken($userLogin,$token))
    {
      $limit = isset($request->limit)? $request->limit:12;
      $offset = isset($request->offset)? $request->offset:0;
      $thread = DB::table('participants')->select('thread_id')->where('user_id',$userLogin)->groupBy('thread_id')->orderBy('updated_at')->limit($limit)->offset($offset*$limit);
      foreach($thread as $key=>$row)
      {
        $data[$key] = $this->getThreadInfo($thread->thread_id);
      }
      return response()->json([
        'status' => 'success',
        'hasil' => $data
      ]);
    }
  }
  
}
