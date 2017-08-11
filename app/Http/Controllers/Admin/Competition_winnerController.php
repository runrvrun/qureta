<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Competition_winner;
use Illuminate\Http\Request;
use Session;

class Competition_winnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $competition_winner = Competition_winner::paginate(25);

        return view('admin.competition_winner.index', compact('competition_winner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.competition_winner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Competition_winner::create($requestData);

        Session::flash('flash_message', 'Competition_winner added!');

        return redirect('admin/competition_winner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $competition_winner = Competition_winner::findOrFail($id);

        return view('admin.competition_winner.show', compact('competition_winner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $competition_winner = Competition_winner::findOrFail($id);

        return view('admin.competition_winner.edit', compact('competition_winner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $competition_winner = Competition_winner::findOrFail($id);
        $competition_winner->update($requestData);

        Session::flash('flash_message', 'Competition_winner updated!');

        return redirect('admin/competition_winner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Competition_winner::destroy($id);

        Session::flash('flash_message', 'Competition_winner deleted!');

        return redirect('admin/competition_winner');
    }
}
