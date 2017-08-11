<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\Competition_post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Session;
use DB;
use Carbon;

class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $pagetitle = 'Lomba Esai';
        $lombas = Competition::where('competition_startdate','<=',Carbon::today()->toDateString())->where('competition_enddate','>=',Carbon::today()->toDateString())->paginate(25);

        return view('pages.lomba', compact('pagetitle','lombas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function peserta()
    {
        if(Auth::check()){
         $competitions = Competition::with('comp_authors')->where('competition_startdate','<=',Carbon::today()->toDateString())->where('competition_enddate','>=',Carbon::today()->toDateString())->orderBy('competition_enddate', 'DESC')->paginate(25);

         return view('pages.peserta_lomba', compact('competitions'));
        }
        else{
            return redirect('/login');
        }
        
    }

    public function post_peserta($competitionid)
    {
        if(Auth::check()){
            $competition_posts = Competition_post::select(DB::raw('*,(select count(1) from competition_postlikes where competition_post_id = competition_posts.id) like_count'))->with('comps', 'composts')->where('competition_id', $competitionid)->orderBy('id', 'DESC')->paginate(25);

            return view('pages.post_peserta', compact('competition_posts'));
        }
        else{
            return redirect('/login');
        }
        
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
