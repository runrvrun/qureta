<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon;
use Session;
use App\Followers;
use Image;
use User;
use DB;
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
    public function checkFollow ($userLogin,$id)
    {
      $data = DB::table('followers')->where('follower_id',$userLogin)->where('user_id',$id)->count();
      if($data!=0)
      {
        return true;
      }
      else
      {
        return false; 
      }
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
      $userLogin = isset($request->userLogin)? $request->userLogin:0;
      $token = isset($request->token)? $request->token:0;
      if($request->get=="slug")
      {
        $request->id = getId($request->id);
      }
      $user = \App\User::select('id','username','name','email','phone_number','role','user_image','post_count')->where('id',$request->id)->first();
      $data['user_id']=$user->id;
      $data['username']=$user->username;
      $data['name']=$user->name;
      //$data['email']=$user->email;
      $data['phone']=$user->phone_number;
      $data['email']=$user->email;
      $data['role']=$user->role;
      $data['user_image']=asset('/uploads/avatar/')."/".$user->user_image;
      $data['post_count']=$user->post_count;
      $um = \App\User_metum::where('user_id',$request->id)->get();
      foreach($um as $umm){
        $uma[$umm->meta_name] = $umm->meta_value;
      }
      $data['kota']=isset($uma['kota'])? $uma['kota']:'';
      $data['minat']=isset($uma['minat'])? $uma['minat']:'';
      $data['pendidikan']=isset($uma['pendidikan'])? $uma['pendidikan']:'';
      $data['profesi']=isset($uma['profesi'])? $uma['profesi']:'';
      $data['short_bio']=isset($uma['short_bio'])? $uma['short_bio']:'';
      $data['tanggal_lahir']=isset($uma['tanggallahir'])? $uma['tanggallahir']:'';
      $data['tempat_lahir']=isset($uma['tempatlahir'])? $uma['tempatlahir']:'';
      $data['twitter']=isset($uma['twitter'])? $uma['twitter']:'';
      $data['linkedin']=isset($uma['linkedin'])? $uma['linkedin']:'';
      $data['website']=isset($uma['website'])? $uma['website']:'';
      $data['follow']=$this->checkFollow($userLogin,$user->id);
      $data['follower']=\App\Followers::where('user_id',$request->id)->count();
      $data['following']=\App\Followers::where('follower_id',$request->id)->count();
      return response()->json([
        'success' => true,
        'hasil' => $data
      ]);
    }
    public function getMetaProfile (Request $request)
    {
      $um = \App\User_metum::where('user_id',$request->id)->get();
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
      $userLogin = $request->userLogin;
      $token = $request->token;
      $id = $request->id;
      if($this->checkToken($userLogin,$token))
      {
        $id = $request->id;
        if($this->checkFollow($userLogin,$id))
        {
          $id = \App\User::find($id);
          $userLogin = \App\User::find($userLogin);
          $id->unfollow($userLogin);
          return response()->json([
          'status' => 'success',
          'hasil' => ['sukses' => true,'follow' => $this->checkFollow($userLogin,$id)]
          ]);
        }
        else
        {
          $id = \App\User::find($id);
          $userLogin = \App\User::find($userLogin);
          $id->follow($userLogin);
          return response()->json([
          'status' => 'success',
          'hasil' => ['sukses' => true,'follow' => $this->checkFollow($userLogin,$id)]
          ]);
        }
      }
    }
    public function getQuretans (Request $request)
    {
      $userLogin = isset($request->userLogin)? $request->userLogin:0;
      $token = isset($request->token)? $request->token:0;
      $limit = isset($request->limit)? $request->limit:10;
      $offset = isset($request->offset)? $request->offset:0;
      $user = \App\User::select('id','name','username','role as user_role','user_image','post_count')
      ->where('status', 1)->where('post_count','>','0')->orderBy('post_count','DESC')->limit($limit)->offset($offset*$limit)->get();
      foreach($user as $key=>$row)
      {
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','profesi')->first();
          $userImage = parse_url($user[$key]['user_image']);
          if (empty($userImage['scheme'])) {
            $userImage = "http://qureta.com/uploads/avatar/".$user[$key]['user_image'];
          }
          else
          {
            $userImage = $user[$key]['user_image'];
          }
          $user[$key]['user_image'] = $userImage;
          $user[$key]['user_profesi'] = isset($um)? $um->meta_value:'';
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','short_bio')->first();
          $user[$key]['short_bio'] = isset($um)? $um->meta_value:'';
          $user[$key]['follower_count'] =  \App\Followers::where('user_id', $row->id)->count();
          $user[$key]['following_count'] =  \App\Followers::where('follower_id', $row->id)->count();
          $user[$key]['follow'] =  \App\Followers::where('user_id', $row->id)->where('follower_id', $userLogin)->count()==1?true:false;
      }
      return response()->json([
        'status' => 'success',
        'hasil' => $user
      ]);
    }
    public function getSearchUser (Request $request)
    {
      $search = $request->search;
      $limit = isset($request->limit)? $request->limit:10;
      $offset = isset($request->offset)? $request->offset:0;
      $userLogin = isset($request->userLogin)? $request->userLogin:0;
      $token = isset($request->token)? $request->token:0;
      $user = \App\User::select('id','name','username','role as user_role','user_image','post_count')
      ->where('status', 1)->where('post_count','>','0')->where('name','like','%'.$search.'%')->limit($limit)->offset($offset)->get();
      foreach($user as $key=>$row)
      {
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','profesi')->first();
          $user[$key]['user_profesi'] = isset($um)? $um->meta_value:'';
          $um =  \App\User_metum::select('meta_value')->where('user_id', $row->id)->where('meta_name','short_bio')->first();
          $user[$key]['short_bio'] = isset($um)? $um->meta_value:'';
          $user[$key]['follower_count'] =  \App\Followers::where('user_id', $row->id)->count();
          $user[$key]['following_count'] =  \App\Followers::where('follower_id', $row->id)->count();
          $user[$key]['follow'] =  \App\Followers::where('user_id', $row->id)->where('follower_id', $userLogin)->count();
      }
      return response()->json([
        'status' => 'success',
        'hasil' => $user
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

    public function editProfile(Request $request)
    {
      $userLogin = $request->userLogin;
      $token = $request->token;
      if($this->checkToken($userLogin,$token))
      {
        $status;
        if(isset($request->name))
        {
          $status = $this->setName($userLogin,$request->name);
        }
        if(isset($request->email))
        {
          $status = $this->setEmail($userLogin,$request->email);
        }
        if(isset($request->phoneNumber))
        {
          $status = $this->setPhone_number($userLogin,$request->phoneNumber);
        }
        if(isset($request->kota))
        {
          $status = $this->setKota($userLogin,$request->kota);
        }
        if(isset($request->linkedIn))
        {
          $status = $this->setLinkedin($userLogin,$request->linkedIn);
        }
        if(isset($request->minat))
        {
          $status = $this->setMinat($userLogin,$request->minat);
        }
        if(isset($request->pendidikan))
        {
          $status = $this->setPendidikan($userLogin,$request->pendidikan);
        }
        if(isset($request->profesi))
        {
          $status = $this->setProfesi($userLogin,$request->profesi);
        }
        if(isset($request->shortBio))
        {
          $status = $this->setShortBio($userLogin,$request->shortBio);
        }
        if(isset($request->tanggalLahir))
        {
          $status = $this->setTanggalLahir($userLogin,$request->tanggalLahir);
        }
        if(isset($request->tempatLahir))
        {
          $status = $this->setTempatLahir($userLogin,$request->tempatLahir);
        }
        if(isset($request->twitter))
        {
          $status = $this->setTwitter($userLogin,$request->twitter);
        }
        if(isset($request->website))
        {
          $status = $this->setWebsite($userLogin,$request->website);
        }
        if(isset($request->pass))
        {
          $status = $this->setPass($userLogin,$request->pass);
        }
        if ($request->hasFile('avatar')) {
          $uploadPath = public_path('/uploads/avatar/');
          $extension = 'jpg';
          $fileName = rand(11111, 99999) . '.' . $extension;
          $file = $request->file('avatar');
          Image::make($file->getRealPath())->fit(240, 240)->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();
          $user = \App\User::where('id',$userLogin)->first();
          $user['user_image'] = $fileName;
          $user->save();
          $status = true;
        }
        return response()->json([
        'status' => 'success',
        'hasil' => $status
      ]);
      }
    }

    public function setName ($userLogin,$value)
    {
      \App\User::where('id', $userLogin)->update(['name' => $value]);
      return true;
    }
    public function setEmail ($userLogin,$value)
    {
      \App\User::where('id', $userLogin)->update(['email' => $value]);
      return true;
    }
    public function setPhone_number ($userLogin,$value)
    {
      \App\User::where('id', $userLogin)->update(['phone_number' => $value]);
        return true;
    }
    public function setProfesi ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'profesi']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'profesi';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setKota ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'kota']);
      $um->delete();
      $requestData['user_id'] = $userLogin;
      $requestData['meta_name'] = 'kota';
      $requestData['meta_value'] = $value;
      \App\User_metum::create($requestData);
      return true;
    }
    public function setLinkedin ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'linkedin']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'linkedIn';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setMinat ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'minat']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'minat';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setPendidikan ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'pendidikan']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'pendidikan';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setShortBio ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'short_bio']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'short_bio';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setTanggalLahir ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'tanggallahir']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'tanggallahir';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setTempatLahir ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'tempatlahir']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'tempatlahir';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setTwitter ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'twitter']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'twitter';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setWebsite ($userLogin,$value)
    {
      $um = \App\User_metum::where('user_id', $userLogin)->where(['meta_name' => 'website']);
        $um->delete();
        $requestData['user_id'] = $userLogin;
        $requestData['meta_name'] = 'website';
        $requestData['meta_value'] = $value;
        \App\User_metum::create($requestData);
        return true;
    }
    public function setPass ($userLogin,$value)
    {
      
      \App\User::where('id', $userLogin)->update(['password' => bcrypt($value)]);
      return true;
    }
  }
