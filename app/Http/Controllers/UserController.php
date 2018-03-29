<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Response;
use App\User;
use App\Followers;

class UserController extends Controller {

    public function __construct() {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('pages.userlist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function follow(Request $request) {
        $userid = $request->userid;
        $followerid = $request->followerid;
        $user = User::find($userid);
        $follower = User::find($followerid);
        $user->follow($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function unfollow(Request $request) {
        $userid = $request->userid;
        $followerid = $request->followerid;
        $user = User::find($userid);
        $follower = User::find($followerid);
        $user->unfollow($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function ddjson() {
        $users = User::pluck('id', 'username');
        return Response::json($users);
    }

    public function marknotifasread(Request $request) {
        $userid = $request->userid;
        $user = User::find($userid);
        $user->unreadNotifications->markAsRead();
    }

     public function autoComplete(Request $request) {
        $query = $request->get('term','');

        $user=User::where('username','LIKE','%'.$query.'%')->orWhere('name','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($user as $users) {
                $data[]=array('label'=>$users->username,'id'=>$users->id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

}
