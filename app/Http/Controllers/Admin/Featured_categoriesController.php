<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Featured_category;
use Illuminate\Http\Request;
use Session;

class Featured_categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $featured_categories = Featured_category::paginate(25);

        return view('admin.featured_categories.index', compact('featured_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.featured_categories.create');
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
			'category_title' => 'required'
		]);
        $requestData = $request->all();
        
        Featured_category::create($requestData);

        Session::flash('flash_message', 'Featured_category added!');

        return redirect('admin/featured_categories');
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
        $featured_category = Featured_category::findOrFail($id);

        return view('admin.featured_categories.show', compact('featured_category'));
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
        $featured_category = Featured_category::findOrFail($id);

        return view('admin.featured_categories.edit', compact('featured_category'));
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
			'category_title' => 'required'
		]);
        $requestData = $request->all();
        
        $featured_category = Featured_category::findOrFail($id);
        $featured_category->update($requestData);

        Session::flash('flash_message', 'Featured_category updated!');

        return redirect('admin/featured_categories');
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
        Featured_category::destroy($id);

        Session::flash('flash_message', 'Featured_category deleted!');

        return redirect('admin/featured_categories');
    }
}
