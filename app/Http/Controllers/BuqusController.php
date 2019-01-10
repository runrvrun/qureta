<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Buqu;
use App\Buqu_post;
use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Auth;
use Image;
use DB;
use Carbon;

class BuqusController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        if (Auth::user()->role = 'admin') {
            $buqus = Buqu::where('buqu_author', Auth::user()->id)->paginate(25);
        } else {
            $buqus = Buqu::paginate(25);
        }

        return view('buqus.index', compact('buqus'));
    }

    public function showpermalink($permalink) {
        $buqu = Buqu::where('buqu_slug', '=', $permalink)->first();
	       if($buqu == null) abort('404');
         $pagetitle = $buqu->buqu_title;
        $buqu_posts = Buqu_post::where('buqu_id', $buqu->id)->pluck('post_id');
        $posts = Post::with('post_authors')->whereIn('id', $buqu_posts)->where('post_status', 'publish')->paginate(12);

        if (is_null($buqu)) {
            abort(404);
        }

        return view('pages.buqusingle', compact('buqu', 'posts', 'categories', 'pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        $this->middleware('auth');

        if (Auth::guest()) {
            return redirect()->guest('login');
        }

	if(is_banned(Auth::user()->id)){
	    Auth::logout();
            return redirect('/login');
	}

        return view('pages.buqu_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
	if(is_banned(Auth::user()->id)){
	    Auth::logout();
            return redirect('/login');
	}
        $this->validate($request, [
            'buqu_title' => 'required|regex:/^([0-9a-zA-Z].*+)$/',
            'buqu_image' => 'max:2000',
        ]);
        $requestData = $request->all();


        if ($request->hasFile('buqu_image')) {
            $uploadPath = public_path('/uploads/buqu/');

            $extension = 'jpg';
            $fileName = rand(11111, 99999) . '.' . $extension;

            $file = $request->file('buqu_image');
            Image::make($file->getRealPath())->fit(214, 321)->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();

            //$request->file('buqu_image')->move($uploadPath, $fileName);
            $requestData['buqu_image'] = $fileName;
        }

        $buqu = Buqu::create($requestData);

        Session::flash('flash_message', 'Buqu ' . $request->buqu_title . ' added!');
        Session::flash('new_buqu_id', $buqu->id);

        if (Session::has('redirect_post_id')) {
            return redirect('/buqu_posts/create/' . Session::get('redirect_post_id'));
        } else {
            return redirect('/buqu/' . $buqu->buqu_slug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $buqus = Buqu::findOrFail($id);

        return view('buqus.show', compact('buqus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        if(Auth::check()){
          $buqus = Buqu::findOrFail($id);

          if ($buqus->buqu_author == Auth::user()->id || (Auth::user()->role === 'admin' || Auth::user()->role === 'editor')) {
              return view('buqus.edit', compact('buqus'));
          } else {
              Session::flash('flash_message', 'You are not authorized to edit this buqu');
              return redirect('/');
          }
        }else{
          abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {
	if(is_banned(Auth::user()->id)){
	    Auth::logout();
            return redirect('/login');
	}
        $this->validate($request, [
            'buqu_title' => 'required|regex:/^([0-9a-zA-Z].*+)$/'
        ]);
        $requestData = $request->all();


        if ($request->hasFile('buqu_image')) {
            $uploadPath = public_path('/uploads/buqu/');

            $extension = 'jpg';
            $fileName = rand(11111, 99999) . '.' . $extension;

            $file = $request->file('buqu_image');
            Image::make($file->getRealPath())->fit(196, 295)->encode('jpg', 75)->save($uploadPath . $fileName);

            $requestData['buqu_image'] = $fileName;
        }

        $buqus = Buqu::findOrFail($id);
        $buqus->update($requestData);

        Session::flash('flash_message', 'Buqu updated!');

        return redirect('/buqu/' . $buqus->buqu_slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Buqu::destroy($id);

        Session::flash('flash_message', 'Buqu deleted!');

        return redirect('buqu');
    }

    public function terbaru(Request $request) {
        $pagetitle = 'Buqu Terbaru';
        $buqus = Buqu::orderBy('id', 'DESC')->paginate(20);

        return view('pages.buqu', compact('pagetitle', 'buqus'));
    }

    public function populer($limit = 20) {
        $pagetitle = 'Buqu Terpopuler';
        $buqus = Buqu::orderBy('view_count', 'DESC')->take($limit)->get();

        return view('pages.buqu', compact('pagetitle', 'buqus'));
    }

    public function pilihan($limit = 20) {
        $pagetitle = 'Buqu Pilihan';
        $buqus = Buqu::where('featured_at','>',0)->orderBy('featured_at', 'DESC')->take($limit)->get();

        return view('pages.buqu', compact('pagetitle', 'buqus'));
    }

     public function rakbuqu() {
        if (Auth::check()) {
            $pagetitle = 'Rak Buqu';
            $buqus = Buqu::whereHas('buqulikes', function($query) {
                        $query->where('follower_id', Auth::user()->id);
                    })->with('buqu_authors')->orderBy('id', 'DESC')->paginate(12);

            return view('pages.buqu', compact('pagetitle', 'buqus'));
        } else {
            return Redirect::route('login')->with('message', 'Anda harus login');
        }
    }

    public function like(Request $request) {
        $buquid = $request->postid;
        $followerid = $request->followerid;
        $buqu = Buqu::find($buquid);
        $follower = User::find($followerid);
        $buqu->like($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function unlike(Request $request) {
        $buquid = $request->postid;
        $followerid = $request->followerid;
        $buqu = Buqu::find($buquid);
        $follower = User::find($followerid);
        $buqu->unlike($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function incrementsharecounter(Request $request) {
        $id = $request->id;
        DB::table('buqus')->whereId($id)->increment('share_count');
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function incrementlikecounter(Request $request) {
        $id = $request->postid;
        DB::table('buqus')->whereId($id)->increment('like_count');
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function decrementlikecounter(Request $request) {
        $id = $request->postid;
        DB::table('buqus')->whereId($id)->decrement('like_count');
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function feature(Request $request) {
        $id = $request->postid;
        $buqu = Buqu::find($id);
        $requestData['featured_at'] = Carbon::now()->toDateTimeString();
        $buqu->update($requestData);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function unfeature(Request $request) {
        $id = $request->postid;
        $buqu = Buqu::find($id);
        $buqu->featured_at = null;
        $buqu->save();
        return response()->json(['responseText' => 'Success!'], 200);
    }


}
