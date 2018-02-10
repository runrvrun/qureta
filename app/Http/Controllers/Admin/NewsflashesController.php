<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Newsflash;
use Illuminate\Http\Request;
use Session;

class NewsflashesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $newsflashes = Newsflash::paginate(25);

        return view('admin.newsflashes.index', compact('newsflashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.newsflashes.create');
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
        $this->validate($request, [
			'text' => 'required'
		]);
        $requestData = $request->all();

        Newsflash::create($requestData);

        Session::flash('flash_message', 'Newsflash added!');

        return redirect('admin/newsflash');
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
        $newsflash = Newsflash::findOrFail($id);

        return view('admin.newsflashes.show', compact('newsflash'));
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
        $newsflash = Newsflash::findOrFail($id);

        return view('admin.newsflashes.edit', compact('newsflash'));
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
        $this->validate($request, [
			'text' => 'required'
		]);
        $requestData = $request->all();

        $newsflash = Newsflash::findOrFail($id);
        $newsflash->update($requestData);

        Session::flash('flash_message', 'Newsflash updated!');

        return redirect('admin/newsflash');
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
        Newsflash::destroy($id);

        Session::flash('flash_message', 'Newsflash deleted!');

        return redirect('admin/newsflash');
    }
}
