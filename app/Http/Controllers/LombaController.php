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

     public function __construct()
     {
       date_default_timezone_set('Asia/Jakarta');
     }

    public function index()
    {
        $pagetitle = 'Lomba Esai';
        $lombas = Competition::where('competition_startdate','<=',Carbon::now())->where('competition_enddate','>',Carbon::now())->paginate(25);

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
         $competitions = Competition::with('comp_authors')->where('competition_startdate','<=',Carbon::now())->where('competition_enddate','>=',Carbon::now())->orderBy('competition_enddate', 'DESC')->paginate(25);

         return view('pages.peserta_lomba', compact('competitions'));
        }
        else{
            return redirect('/login');
        }

    }

    public function post_peserta($competitionid)
    {
        if(Auth::check()){
            $competition_posts = Competition_post::with('comps', 'composts')->where('competition_id',$competitionid)->join('posts','posts.id', '=', 'competition_posts.post_id')->where('post_status', '=', 'publish')->orderBy('posts.published_at','DESC')->get();
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
