<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Competition;
use App\Competition_post;
use App\Competition_winner;
use App\Post;
use Illuminate\Http\Request;
use Session;
use Carbon;

class CompetitionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $competitions = Competition::with('comp_authors')->orderBy('competition_enddate', 'DESC')->paginate(25);

        return view('admin.competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('admin.competitions.create');
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
            'competition_title' => 'required'
        ]);
        $requestData = $request->all();
        $requestData['competition_startdate'] = Carbon::createFromFormat('d/m/Y H.i',$requestData['competition_startdate'])->format('Y-m-d H:i:s');
        $requestData['competition_enddate'] = Carbon::createFromFormat('d/m/Y H.i',$requestData['competition_enddate'])->format('Y-m-d H:i:s');

        Competition::create($requestData);

        Session::flash('flash_message', 'Competition added!');

        return redirect('admin/competitions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $competition = Competition::with('comp_authors')->findOrFail($id);
        $winners = Competition_post::with('composts')->where('nilai', '>', '0')->orderBy('nilai', 'DESC')->get();

        return view('admin.competitions.show', compact('competition', 'winners'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $competition = Competition::with('comp_authors')->findOrFail($id);
        $competition_posts = Competition_post::with('comps', 'composts')->where('competition_id', $competition->id)->pluck('post_id')->toArray();
        $posts = Post::whereIn('id', $competition_posts)->orderBy('post_title')->pluck('post_title', 'id')->toArray();
        $winners = Competition_winner::where('competition_id', $competition->id)->orderBy('rank')->get()->toArray();
        $rankpost = array();
        $ranktitle = array();
        for ($i = 0; $i < count($winners); $i++) {
            $rankpost[$i] = $winners[$i]['post_id'];
            $ranktitle[$i] = $winners[$i]['ranktitle'];
        }
        return view('admin.competitions.edit', compact('competition', 'posts', 'rankpost', 'ranktitle'));
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
            'competition_title' => 'required'
        ]);
        $requestData = $request->all();

        $requestData['competition_startdate'] = Carbon::createFromFormat('d/m/Y H.i',$requestData['competition_startdate'])->format('Y-m-d H:i:s');
        $requestData['competition_enddate'] = Carbon::createFromFormat('d/m/Y H.i',$requestData['competition_enddate'])->format('Y-m-d H:i:s');

        $competition = Competition::findOrFail($id);
        $competition->update($requestData);

        //update winners
        //delete existing winners, then re-insert
        $deletedRows = Competition_winner::where('competition_id', $id)->delete();
        for ($i = 0; $i < count($request->rank); $i++) {
            if (isset($request->rankpost[$i]) && $request->rankpost[$i] > 0) {
                $requestData = ['competition_id' => $id, 'rank' => $request->rank[$i], 'ranktitle' => $request->ranktitle[$i], 'post_id' => $request->rankpost[$i]];
                Competition_winner::create($requestData);
            }
        }

        Session::flash('flash_message', 'Competition updated!');

        return redirect('admin/competitions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Competition::destroy($id);

        Session::flash('flash_message', 'Competition deleted!');

        return redirect('admin/competitions');
    }

}
