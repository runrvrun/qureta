<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Workshop_post;
use App\Workshop_files;
use Illuminate\Http\Request;
use Session;
use DB;

class Workshop_postsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($id = null) {
       
        $workshop_posts = Workshop_files::where('workshop_id',$id)->get();

        return view('admin.workshop_posts.index', compact('workshop_posts'));
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
            $workshop_posts = Workshop_files::findOrFail($id);

        return view('admin.workshop_posts.index', compact('workshop_posts'));
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

     public function files($id, $user_id) {
        $workshop = Workshop_files::where('workshop_id',$id)->where('user_id',$user_id)->get();
        $id = $id;
        return view('admin.workshops.files_peserta', compact('workshop','id'));
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

    public function peserta($id) {
       
        $workshop_posts = Workshop_files::where('workshop_id',$id)->get();

        return view('admin.workshop_posts.index', compact('workshop_posts'));
    }

}
