<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Workshop_post;
use App\Workshop;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Session;
use Carbon;

class WorkshopController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {

        $workshops = Workshop::with('workshop_authors')->orderBy('workshop_enddate', 'DESC')->paginate(25);
      //  $jml_peserta = Workshop_post::count('name');
        // $workshop_posts = Workshop_post::with('workshop_posts')->where('workshop_id',$workshopid->id)->count('workshop_id');

        return view('admin.workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('admin.workshops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        $this->validate($request, [
            'workshop_title' => 'required',
            'workshop_author' => 'required'
        ]);
        $requestData = $request->all();

        $requestData['workshop_startdate'] = Carbon::parse($requestData['workshop_startdate'])->format('Y-m-d H:i:s');
        $requestData['workshop_enddate'] = Carbon::parse($requestData['workshop_enddate'])->format('Y-m-d H:i:s');

        Workshop::create($requestData);

        Session::flash('flash_message', 'Workshop added!');

        return redirect('admin/workshops');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $workshop = Workshop::with('workshop_authors')->findOrFail($id);
        $winners = Workshop_post::with('composts')->where('nilai', '>', '0')->orderBy('nilai', 'DESC')->get();

        return view('admin.workshops.show', compact('workshop', 'winners'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $workshop = Workshop::with('workshop_authors')->findOrFail($id);
        
        return view('admin.workshops.edit', compact('workshop'));
    }

    public function peserta($id) {
        $workshop = Workshop_post::where('workshop_id',$id)->orderBy('id','DESC')->get();
        
        return view('admin.workshops.peserta', compact('workshop'));
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
        $this->validate($request, [
            'workshop_title' => 'required'
        ]);
        $requestData = $request->all();

        $requestData['workshop_startdate'] = Carbon::parse($requestData['workshop_startdate'])->format('Y-m-d H:i:s');
        $requestData['workshop_enddate'] = Carbon::parse($requestData['workshop_enddate'])->format('Y-m-d H:i:s');

        $workshop = Workshop::findOrFail($id);
        $workshop->update($requestData);

        //update winners
        //delete existing winners, then re-insert
       

        Session::flash('flash_message', 'Workshop updated!');

        return redirect('admin/workshops');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Workshop::destroy($id);

        Session::flash('flash_message', 'Workshop deleted!');

        return redirect('admin/competitions');
    }

}
