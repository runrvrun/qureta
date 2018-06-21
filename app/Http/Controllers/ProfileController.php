<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\User_metum;
use App\Post;
use App\Buqu;
use App\Followers;
use Session;
use Image;
use DB;
use Illuminate\Support\Facades\Redirect;
use Carbon;
use App\Mail\EmailFillProfession;
use Mail;

class ProfileController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_id = Auth::user()->id;
        $profile = ''; //get user_meta where user_id=$user_id
        return view('pages.profile', ['profile' => $profile]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function update(Request $request) {
	if(is_banned(Auth::user()->id)){
	    Auth::logout();
            return redirect('/login');
	}
        if(!isset($request->recommended)){
            $request->recommended=0;
        }
        $this->validate($request, [
            'name' => 'required',
            'profesi' => 'required|max:20'
        ]);

        if ($request->hasFile('user_image_cover')) {
            $uploadPath = public_path('/uploads/cover/');

            $extension = 'jpg';
            $fileName = rand(11111, 99999) . '.' . $extension;

            $file = $request->file('user_image_cover');
            Image::make($file->getRealPath())->fit(1350, 525)->encode('jpg', 100)->save($uploadPath . $fileName)->destroy();

            // $request->file('buqu_image')->move($uploadPath, $fileName);
            $requestData['user_image_cover'] = $fileName;
        }

        if ($request->hasFile('user_image')) {
            $uploadPath = public_path('/uploads/avatar/');

            $extension = 'jpg';
            $fileName = rand(11111, 99999) . '.' . $extension;

            $file = $request->file('user_image');
            Image::make($file->getRealPath())->fit(240, 240)->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();

            //$request->file('buqu_image')->move($uploadPath, $fileName);
            $requestData['user_image'] = $fileName;
            
        }

        $requestData['name'] = $request->name;
        $requestData['phone_number'] = $request->phone_number;
        $user = User::findOrFail($request->user_id);
        $user->update($requestData);

        $profile_fields = array('tempatlahir', 'tanggallahir', 'profesi', 'short_bio', 'email', 'kota', 'minat', 'pendidikan', 'website', 'twitter', 'linkedin','recommended');
        //TODO: buat lebih dinamis dengan $key (maybe)

        $request->tanggallahir = Carbon::parse($request->tanggallahir)->format('Y-m-d H:i:s');
        //dd($request);
        foreach ($profile_fields as $p) {
            $pid = $p . '_id';

            if($p == 'tanggallahir' && $request->$p == '1900-01-01 00:00:00'){
                $request->$p = '';
            }

            $requestData = array('user_id' => $user->id, 'meta_name' => $p, 'meta_value' => $request->$p);
            if ($request->$pid == '') {
                User_metum::create($requestData);
            } else {
                $user_metum = User_metum::findOrFail($request->$pid);
                $user_metum->update($requestData);
            }
        }

        Session::flash('flash_message', 'Profile updated! <a href="'.url('/profile/'.$user->username).'">View Profile</a>');

        return redirect('/profile/edit/'.$user->id);
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
    public function edit($userid = null) {
        if(isset($userid)){
            $user = User::findOrFail($userid);
        }else{
            $user = User::findOrFail(Auth::user()->id);
        }
        $profile = User_metum::where('user_id', $user->id)->get();
        foreach ($profile as $row) {
            $meta = $row->meta_name;
            $meta_id = $meta . '_id';
            $profile->$meta = $row->meta_value;
            $profile->$meta_id = $row->id;
        }

        if(!isset($profile->tanggallahir)){
            $profile->tanggallahir = '1900-01-01 00:00:00';
        }

        return view('pages.editprofile', compact('user', 'profile'));
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

    public function profil($username = null) {
        $pagetitle = 'Profil';
        if ($username == null) {
            $username = Auth::User()->username;
        }
        $users = User::whereRaw('BINARY username = ?',array($username))->first();
        $user_metum = User_metum::where('user_id', $users->id)->get();
        $profile = array();
        if (count($user_metum) > 0) {
            foreach ($user_metum as $row) {
                $profile[$row->meta_name] = $row->meta_value;
            }
        }
        $posts = Post::where('post_author', $users->id)->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->take(4)->get();
        $buqus = Buqu::where('buqu_author', $users->id)->orderBy('id', 'DESC')->take(4)->get();
        $followers = Followers::join('users','follower_id','=','users.id')->where('user_id', $users->id)->orderBy('users.name', 'ASC')->paginate(50, ['*'], 'followerpage');

        $jml_followers = Followers::where('user_id',$users->id)->distinct('follower_id')->count('follower_id');
        $jml_following = Followers::where('follower_id',$users->id)->distinct('user_id')->count('user_id');
        $jml_post = Post::where('post_author', $users->id)->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->count('id');
        $jml_buqu = Buqu::where('buqu_author', $users->id)->count('id');

        $followings = Followers::join('users','user_id','=','users.id')->where('follower_id', $users->id)->orderBy('users.name', 'ASC')->paginate(50, ['*'], 'followingpage');

        return view('pages.profile', compact('pagetitle', 'users', 'profile', 'posts', 'buqus', 'followers', 'followings','jml_post','jml_buqu','jml_followers','jml_following'));
    }

    public function terbaru($limit = 52) {
        //penulis yang baru pertama membuat tulisan yang terbaru
        $pagetitle = 'Penulis Terbaru';
        $users = DB::select("SELECT u.id, u.name, u.user_image, u.username, p.*
FROM users u
LEFT JOIN posts p ON u.id=p.post_author
WHERE u.status=1 and p.id = (SELECT MIN(id) FROM posts WHERE post_author=u.id and post_status='publish' and hide=0 and published_at < now())
ORDER BY p.published_at DESC LIMIT 52");

        return view('pages.penulisterbaru', compact('pagetitle', 'users'));
    }

    public function populer($limit = 20) {
        //penulis dengan follower terbanyak
        $pagetitle = 'Penulis Terpopuler';
        $users = DB::select("select u.id post_author, count(f.id) total_followers, u.name, u.username, u.user_image, u.role
from followers f
INNER JOIN users u ON f.user_id = u.id
WHERE u.status=1 and username NOT IN ('qlomba', 'qworkshop','dimashendrasasmita')
group by u.id, u.name, u.username, u.user_image, u.role  order by count(f.id) desc limit ".$limit);

        return view('pages.penulispopuler', compact('pagetitle', 'users'));
    }

   public function favorit($limit = 50) {
        //penulis dengan post view terbanyak
        $pagetitle = 'Penulis Terfavorit';
        $users = DB::select("select post_author, sum(view_count) total_view, u.name, u.username, u.user_image, u.role from posts p
INNER JOIN users u ON p.post_author = u.id
WHERE p.post_status = 'publish' AND p.hide = 0 AND p.published_at < now() AND u.status=1
group by post_author, u.name, u.username, u.user_image, u.role  order by sum(view_count) desc limit ".$limit);

        return view('pages.penulisfavorit', compact('pagetitle', 'users'));
    }

    public function produktif($limit = 50) {
        //penulis dengan jumlah tulisan terbit terbanyak
        $pagetitle = 'Penulis Terproduktif';
        $users = DB::select("SELECT post_author, count(p.id) total_post, u.name, u.username, u.user_image, u.role
FROM posts p INNER JOIN users u ON p.post_author = u.id
WHERE p.post_status = 'publish' AND p.hide = 0 AND p.published_at < now() AND u.status=1
GROUP BY post_author, u.name, u.username, u.user_image, u.role ORDER BY count(p.id) desc limit ".$limit);

        return view('pages.penulisproduktif', compact('pagetitle', 'users'));
    }

    public function tulisan($username) {
      $user = User::where('username',$username)->first();
      $pagetitle = 'Tulisan '.$user->name;
      $posts = Post::with('post_authors')->where('post_author',$user->id)->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('id', 'DESC')->paginate(12);

      return view('pages.artikel', compact('pagetitle', 'posts'));
    }

    public function buqu($username) {
      $user = User::where('username',$username)->first();
      $pagetitle = 'Buqu '.$user->name;
      $buqus = Buqu::where('buqu_author',$user->id)->orderBy('id', 'DESC')->paginate(20);

      return view('pages.buqu', compact('pagetitle', 'buqus'));
    }

    public function EmailFillProfession() {
      $usermeta = User_metum::where('meta_name','profesi')->pluck('user_id');
      $users = User::select('email','name')->whereNotIn('id',$usermeta)->orderBy('id','desc')->get();
      //$users = User::select('email','name')->where('username','runrvrun')->orWhere('username','candycalico')->get();

      $i=0;
      $emailpool = [];
      $user100 = $users->chunk(100);
      foreach($user100 as $user){
        //send email to user
        Mail::to('noreply@qureta.com')->bcc($user)->send(new EmailFillProfession());
        foreach($user as $u){
          echo '<pre>'; print_r($u->name.' &lt;'.$u->email.'&gt;'); echo '</pre>';
        }
      }

      return;
    }

}
