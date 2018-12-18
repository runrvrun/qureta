<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Buqu_post;
use App\Buqu;
use App\Post;
use Illuminate\Http\Request;
use Session;
use Auth;
use Carbon;

class Buqu_postsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        //$buqu_posts = Buqu_post::paginate(25);
        //return view('buqu_posts.index', compact('buqu_posts'));
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($postid = 1) {
        if (Auth::guest()) {
            return redirect()->guest('login');
        }

        //save postid to session for redirection after add new buqu
        Session::put('redirect_post_id', $postid);
        //get added new buqu id
        if (Session::has('new_buqu_id')) {
            $newbuquid = Session::get('new_buqu_id');
        }else{
            $newbuquid = null;
        }

        $buqus = Buqu::where('buqu_author', Auth::user()->id)->orderBy('buqu_title')->pluck('buqu_title', 'id');
        $posts = Post::where('id', $postid)->first();
        return view('buqu_posts.create', compact('buqus', 'posts', 'newbuquid'));
    }

    public function createajax(Request $request) {
      $requestData = $request->all();

      $buqu = Buqu::findOrFail($request->buqu_id);
      $post = Post::findOrFail($request->post_id);
      $post->buqus()->detach($request->buqu_id);
      $post->buqus()->attach($request->buqu_id);

      return response()->json(['responseText' => 'Success!', 'buqu_title' => $buqu->buqu_title, 'buqu_slug' => $buqu->buqu_slug], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $requestData = $request->all();

        $buqus = Buqu::findOrFail($request->buqu_id);
        Buqu_post::create($requestData);

        Session::flash('flash_message', 'Buqu_post added!');

        return redirect('buqu/' . $buqus->buqu_slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        //$buqu_post = Buqu_post::findOrFail($id);
        //return view('buqu_posts.show', compact('buqu_post'));
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        //$buqu_post = Buqu_post::findOrFail($id);
        //return view('buqu_posts.edit', compact('buqu_post'));
        return redirect('/');
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

        $requestData = $request->all();

        $buqu_post = Buqu_post::findOrFail($id);
        $buqu_post->update($requestData);

        Session::flash('flash_message', 'Buqu_post updated!');

        return redirect('buqu_posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Buqu_post::destroy($id);

        Session::flash('flash_message', 'Buqu_post deleted!');

        return redirect('buqu_posts');
    }

    public function deletepost(Request $request){
        $postid = $request->postid;
        $buquid = $request->buquid;
        Buqu_post::where('buqu_id', $buquid)->where('post_id', $postid)->delete();
        return response()->json(['responseText' => 'Success!'], 200);
    }

}
