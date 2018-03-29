<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon;
use Session;
use App\Log;

class UserController extends Controller {
    public function randomToken (Request $request)
    {
      $token = bin2hex(random_bytes(10));
      \App\User::where('id', $request->u)->update(['api_token' => $token]);
      return response()->json([
        'status' => 'success',
        'token' => $token,
        'data' => ['id' => $request->u]
      ]);
    }
    public function checkToken (Request $request)
    {
      $user = \App\User::where('id', $request->u)->where(['api_token' => $request->t])->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'token' => $request->t,
          'data' => ['id' => $request->u]
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Invalid token.']
        ]);
      }
    }
    public function getUsername (Request $request)
    {
      $user = \App\User::select('username')->where('id', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getId (Request $request)
    {
      $user = \App\User::select('id')->where('username', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getName (Request $request)
    {
      $user = \App\User::select('name')->where('id', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getEmail (Request $request)
    {
      /*$user = \App\User::select('email')->where('id', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{*/
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      //}
    }
    public function getPhone (Request $request)
    {
      $user = \App\User::select('phone_number')->where('id', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getRole (Request $request)
    {
      $user = \App\User::select('role')->where('id', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getUserImage (Request $request)
    {
      $user = \App\User::select('user_image')->where('id', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getPostCount (Request $request)
    {
      $user = \App\User::select('post_count')->where('id', $request->n)->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getKota (Request $request)
    {
      $user = \App\User_metum::select('meta_value as kota')->where('user_id', $request->n)->where('meta_name','kota')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getLinkedIn (Request $request)
    {
      $user = \App\User_metum::select('meta_value as linkedin')->where('user_id', $request->n)->where('meta_name','linkedin')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getMinat (Request $request)
    {
      $user = \App\User_metum::select('meta_value as minat')->where('user_id', $request->n)->where('meta_name','minat')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getPendidikan (Request $request)
    {
      $user = \App\User_metum::select('meta_value as pendidikan')->where('user_id', $request->n)->where('meta_name','pendidikan')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getProfesi (Request $request)
    {
      $user = \App\User_metum::select('meta_value as profesi')->where('user_id', $request->n)->where('meta_name','profesi')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getShortBio (Request $request)
    {
      $user = \App\User_metum::select('meta_value as short_bio')->where('user_id', $request->n)->where('meta_name','short_bio')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getTanggalLahir (Request $request)
    {
      $user = \App\User_metum::select('meta_value as tanggallahir')->where('user_id', $request->n)->where('meta_name','tanggallahir')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getTempatLahir (Request $request)
    {
      $user = \App\User_metum::select('meta_value as tempatlahir')->where('user_id', $request->n)->where('meta_name','tempatlahir')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getTwitter (Request $request)
    {
      $user = \App\User_metum::select('meta_value as twitter')->where('user_id', $request->n)->where('meta_name','twitter')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getWebsite (Request $request)
    {
      $user = \App\User_metum::select('meta_value as website')->where('user_id', $request->n)->where('meta_name','website')->first();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => $user
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getFollowerCount (Request $request)
    {
      $user = \App\Followers::where('user_id', $request->n)->count();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => ['follower_count' => $user]
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getFollowingCount (Request $request)
    {
      $user = \App\Followers::where('follower_id', $request->n)->count();
      if($user){
        return response()->json([
          'status' => 'success',
          'data' => ['following_count' => $user]
        ]);
      }else{
        return response()->json([
          'status' => 'fail',
          'data' => ['message' => 'Data not found.']
        ]);
      }
    }
    public function getProfile (Request $request)
    {
      if($request->get=="slug")
      {
        $request->n = getId($request->n);
      }
      $user = \App\User::select('id','username','name','email','phone_number','role','user_image','post_count')->where('id',$request->n)->first();
      $data['user_id']=$user->id;
      $data['username']=$user->username;
      $data['name']=$user->name;
      //$data['email']=$user->email;
      $data['phone']=$user->phone_number;
      $data['role']=$user->role;
      $data['user_image']=asset('/uploads/avatar/').$user->image;
      $data['post_count']=$user->post_count;
      $um = \App\User_metum::where('user_id',$request->n)->get();
      foreach($um as $umm){
        $uma[$umm->meta_name] = $umm->meta_value;
      }
      $data['kota']=isset($uma['kota'])? $uma['kota']:'';
      $data['minat']=isset($uma['minat'])? $uma['minat']:'';
      $data['pendidikan']=isset($uma['pendidikan'])? $uma['pendidikan']:'';
      $data['profesi']=isset($uma['profesi'])? $uma['profesi']:'';
      $data['short_bio']=isset($uma['short_bio'])? $uma['short_bio']:'';
      $data['tanggallahir']=isset($uma['tanggallahir'])? $uma['tanggallahir']:'';
      $data['tempatlahir']=isset($uma['tempatlahir'])? $uma['tempatlahir']:'';
      $data['twitter']=isset($uma['twitter'])? $uma['twitter']:'';
      $data['website']=isset($uma['website'])? $uma['website']:'';
      $data['follower']=\App\Followers::where('user_id',$request->n)->count();
      $data['following']=\App\Followers::where('follower_id',$request->n)->count();
      return response()->json([
        'success' => true,
        'data' => $data
      ]);
    }
    public function getMetaProfile (Request $request)
    {
      $um = \App\User_metum::where('user_id',$request->n)->get();
      foreach($um as $umm){
        $uma[$umm->meta_name] = $umm->meta_value;
      }
      $data['kota']=isset($uma['kota'])? $uma['kota']:'';
      $data['minat']=isset($uma['minat'])? $uma['minat']:'';
      $data['pendidikan']=isset($uma['pendidikan'])? $uma['pendidikan']:'';
      $data['profesi']=isset($uma['profesi'])? $uma['profesi']:'';
      $data['short_bio']=isset($uma['short_bio'])? $uma['short_bio']:'';
      $data['tanggallahir']=isset($uma['tanggallahir'])? $uma['tanggallahir']:'';
      $data['tempatlahir']=isset($uma['tempatlahir'])? $uma['tempatlahir']:'';
      $data['twitter']=isset($uma['twitter'])? $uma['twitter']:'';
      $data['website']=isset($uma['website'])? $uma['website']:'';

      switch ($request->get):
      case 'getKota':
      {
        $data = $data['kota'];
        break;
      }
      case 'getLinkedIn':
      {
        $data = $data['linkedin'];
        break;
      }
      case 'getMinat':
      {
        $data = $data['minat'];
        break;
      }
      case 'getPendidikan':
      {
        $data = $data['pendidikan'];
        break;
      }
      case 'getProfesi':
      {
        $data = $data['profesi'];
        break;
      }
      case 'getShortBio':
      {
        $data = $data['short_bio'];
        break;
      }
      case 'getTanggalLahir':
      {
        $data = $data['tanggallahir'];
        break;
      }
      case 'getTempatLahir':
      {
        $data = $data['tempatlahir'];
        break;
      }
      case 'getTwitter':
      {
        $data = $data['twitter'];
        break;
      }
      case 'getWebsite':
      {
        $data = $data['website'];
        break;
      }
      default:
      {
        break;
      }
    endswitch;
      return response()->json([
        'success' => true,
        'data' => $data
      ]);
    }
    public function follow (Request $request)
    {
      $userid = $request->u;
      $followerid = $request->n;
      $user = \App\User::find($userid);
      $follower = \App\User::find($followerid);
      $user->follow($follower);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function unfollow (Request $request)
    {
      $userid = $request->userid;
      $followerid = $request->followerid;
      $user = \App\User::find($userid);
      $follower = \App\User::find($followerid);
      $user->unfollow($follower);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function checkFollow (Request $request)
    {
      $follow = \App\Followers::where('user_id', $request->u)->where('follower_id',$request->n)->count();
      return response()->json([
        'status' => 'success',
        'data' => ['following' => $follow]
      ]);
    }
    public function getQuretans (Request $request)
    {
      $u = isset($request->u)? $request->u:0;
      $l = isset($request->l)? $request->l:10;
      $n = isset($request->n)? $request->n:0;
      $user = \App\User::select('id','name','username','role as user_role','user_image','post_count')
      ->where('status', 1)->where('post_count','>','0')->orderBy('post_count','DESC')->limit($l)->offset($n)->get();
      foreach($user as $key=>$row)
      {
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','profesi')->first();
          $user[$key]['profesi'] = isset($um)? $um->meta_value:'';
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','short_bio')->first();
          $user[$key]['short_bio'] = isset($um)? $um->meta_value:'';
          $user[$key]['follower_count'] =  \App\Followers::where('user_id', $row->id)->count();
          $user[$key]['following_count'] =  \App\Followers::where('follower_id', $row->id)->count();
          $user[$key]['follow'] =  \App\Followers::where('user_id', $row->id)->where('follower_id', $u)->count();
      }
      return response()->json([
        'status' => 'success',
        'data' => $user
      ]);
    }
    public function getSearchUser (Request $request)
    {
      $n = isset($request->n)? $request->n:'';
      $o = isset($request->o)? $request->o:0;
      $u = isset($request->u)? $request->u:0;
      $o--;
      $o = ($o>0 ? $o*6 : 0);
      $user = \App\User::select('id','name','username','role as user_role','user_image','post_count')
      ->where('username','like','%'.$n.'%')->orWhere('name','like','%'.$n.'%')->limit(6)->offset($o)->get();
      foreach($user as $key=>$row)
      {
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','profesi')->first();
          $user[$key]['profesi'] = isset($um)? $um->meta_value:'';
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','short_bio')->first();
          $user[$key]['short_bio'] = isset($um)? $um->meta_value:'';
          $user[$key]['follower_count'] =  \App\Followers::where('user_id', $row->id)->count();
          $user[$key]['following_count'] =  \App\Followers::where('follower_id', $row->id)->count();
          $user[$key]['follow'] =  \App\Followers::where('user_id', $row->id)->where('follower_id', $u)->count();
      }
      return response()->json([
        'status' => 'success',
        'data' => $user
      ]);
    }
    public function getSuggestSearchUser (Request $request)
    {
      $n = isset($request->n)? $request->n:'';
      $l = isset($request->l)? $request->l:20;
      $o = isset($request->o)? $request->o:0;
      $user = \App\User::select('id','username')->where('username','like','%'.$n.'%')->orWhere('name','like','%'.$n.'%')->limit($l)->offset($o)->get();
      return response()->json([
        'status' => 'success',
        'data' => $user
      ]);
    }
    public function setUsername (Request $request)
    {
      \App\User::where('id', $request->id)->update(['username' => $v]);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setName (Request $request)
    {
      \App\User::where('id', $request->id)->update(['name' => $v]);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setEmail (Request $request)
    {
      \App\User::where('id', $request->id)->update(['email' => $v]);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setPhone_number (Request $request)
    {
      \App\User::where('id', $request->id)->update(['phone_number' => $v]);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setUserImage (Request $request)
    {
      \App\User::where('id', $request->id)->update(['user_image' => $v]);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setProfesi (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'profesi']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'profesi';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setKota (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'kota']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'kota';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setLinkedin (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'linkedin']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'linkedin';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setMinat (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'minat']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'minat';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setPendidikan (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'pendidikan']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'pendidikan';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setShortBio (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'short_bio']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'short_bio';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setTanggalLahir (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'tanggallahir']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'tanggal_lahir';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setTempatLahir (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'tempatlahir']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'tempatlahir';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setTwitter (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'twitter']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'twitter';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
    public function setWebsite (Request $request)
    {
      $um = \App\User_metum::where('user_id', $request->id)->where(['meta_name' => 'website']);
      $um->delete();
      $requestData['user_id'] = $request->id;
      $requestData['meta_name'] = 'website';
      $requestData['meta_value'] = $request->v;
      \App\User_metum::create($requestData);
      return response()->json([
        'status' => 'success'
      ]);
    }
}
