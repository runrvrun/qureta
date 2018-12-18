<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Push_subscription;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;

class PushSubscriptionController extends Controller {
  public function __construct()
  {
    date_default_timezone_set('Asia/Jakarta');
  }

    public function save_subscription(Request $request) {
      $requestData = $request->all();
      try{
        $push = Push_subscription::create($requestData);
      }
        catch(\Exception $e){
      }
      return response()->json(['responseText' => 'Store Success!'], 200);
      /*
      $user = \App\User::findOrFail($id);
     $user->updatePushSubscription($request->input('endpoint'), $request->input('keys.p256dh'), $request->input('keys.auth'));
     return response()->json([
     $user->notify(new \App\Notifications\GenericNotification("Terima kasih sudah menghidupkan notifikasi Qureta", "Anda akan mendapatkan notifikasi artikel pilihan Qureta."));
       'success' => true
     ]);
      */
    }

    public function send_notification(Request $request) {
      $requestData = $request->all();
      //push to all subscribed user
      $pushsub = \App\Push_subscription::get();
      foreach($pushsub as $push){
        $a = ($push->user_id == 0) ? 4100:$push->user_id;//if 0, use 4100 (info qureta)
        $user = \App\User::findOrFail($a);
        try{
          $user->notify(new \App\Notifications\FeaturedPost($request->title, $request->body, url('/post/'.$request->url)));
        }
        catch (\Exception $e) {
          return $e->getMessage();
        }
      }
      //return redirect()->back()->withErrors(['msg', 'Push Notification success']);
      Session::flash('flash_message', 'Push Notification Success');//flash message not working, kayaknya session api sama web beda
      return redirect('admin/publishposts');
    }
}
