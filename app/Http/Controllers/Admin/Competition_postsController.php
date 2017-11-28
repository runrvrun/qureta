<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competition_post;
use App\Competition_postlikes;
use App\User;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;

class Competition_postsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($competitionid = null) {
        if (isset($competitionid)) {
        	  if(Auth::user()->role == 'admin' || Auth::user()->role == 'editor' || Auth::user()->role == 'partner'){
                    $competition_posts = Competition_post::select(DB::raw('competition_posts.*,(select count(1) from competition_postlikes where competition_post_id = competition_posts.id) like_count'))->with('comps', 'composts')->join('posts','posts.id', '=', 'competition_posts.post_id')->where('competition_id', $competitionid)->orderBy('posts.post_status', 'DESC')->orderBy('like_count', 'DESC')->get();
		 
                    $competition_likes = Competition_postlikes::where('follower_id','==',Auth::user()->id)->with('comps','composts')->join('posts','posts.id', '=', 'competition_postlikes.competition_post_id')->join('competition_posts','competition_posts.competition_id','=','competition_postlikes.competition_post_id')->where('competition_id',$competitionid)->get();
        	  }else{
                    $competition_posts = Competition_post::select(DB::raw('competition_posts.*,(select count(1) from competition_postlikes where competition_post_id = competition_posts.id) like_count'))->with('comps', 'composts')->join('posts','posts.id', '=', 'competition_posts.post_id')->where('posts.post_status', 'publish')->where('competition_id', $competitionid)->orderBy('posts.post_status', 'DESC')->orderBy('posts.post_title', 'ASC')->get();
                  }
            //$competition_posts = Competition_post::with('comps', 'composts')->where('competition_id',$competitionid)->join('posts','posts.id', '=', 'competition_posts.post_id')->orderBy('competition_posts.id','DESC')->paginate(10);
        } else {
            $competition_posts = Competition_post::with('comps', 'composts')->get();
        }

        return view('admin.competition_posts.index', compact('competition_posts','competition_likes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('admin.competition_posts.create');
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

        Competition_post::create($requestData);

        Session::flash('flash_message', 'Competition_post added!');

        return redirect('admin/competition_posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $competition_post = Competition_post::with('comps', 'composts')->where('post_id', '>', 0)->whereNotNull('post_id')->findOrFail($id);

        return view('admin.competition_posts.show', compact('competition_post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $competition_post = Competition_post::with('comps', 'composts')->findOrFail($id);

        return view('admin.competition_posts.edit', compact('competition_post'));
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

        $competition_post = Competition_post::findOrFail($id);
        $competition_post->update($requestData);

        Session::flash('flash_message', 'Competition_post updated!');

        return redirect('admin/competition_posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Competition_post::destroy($id);

        Session::flash('flash_message', 'Competition_post deleted!');

        return redirect('admin/competition_posts');
    }

    public function like(Request $request) {
        $competitionpostid = $request->postid;
        $followerid = $request->followerid;
        $competition_post = Competition_post::where('id',$competitionpostid)->first();                  
        $follower = User::find($followerid);        
        $competition_post->like($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function likeget($postid, $followerid) {
	// untuk test saja
        $competitionpostid = $postid;
        $followerid = $followerid;
        $competition_post = Competition_post::where('id',$competitionpostid)->first();                
        $follower = User::find($followerid);        
        $competition_post->like($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function unlike(Request $request) {
        $competitionpostid = $request->postid;
        $followerid = $request->followerid;
        $competition_post = Competition_post::where('id',$competitionpostid)->first();    
        $follower = User::find($followerid);
        $competition_post->unlike($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function autocomplete($competitionid,Request $request) {
        $query = $request->get('term','');
        
        $post=Competition_post::with('composts')->where('competition_id',$competitionid)->whereHas('composts',function ($q) use($query){
    $q->where('post_title','LIKE','%'.$query.'%');
})->get();

        $data=array();
        foreach ($post as $p) {
                $data[]=array('label'=>$p->composts['post_title'].' ('.$p->composts->post_authors['name'].')','id'=>$p->composts['id']);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }


}
