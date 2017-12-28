<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Push_subscription;
use Auth;
use Illuminate\Http\Request;
use DB;

class PushSubscriptionController extends Controller {
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
        $user->notify(new \App\Notifications\FeaturedPost($request->title, $request->body, url('/post/'.$request->url)));
      }
      return redirect()->back();
      //return response()->json(['responseText' => 'Push Success!'], 200);

    }
}
