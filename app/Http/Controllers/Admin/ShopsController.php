<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Shop;
use Illuminate\Http\Request;
use Session;
use Yajra\Datatables\Datatables;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.shops.index_dt');
    }
    public function indexdata()
     {
         return Datatables::of(Shop::select('id','name','price','category','link','updated_at'))
         ->addColumn('action', function ($item) {
                  return view('admin.shops.actions', compact('item'))->render();
          })->make(true);
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.shops.create');
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
			'name' => 'required'
		]);
        $requestData = $request->all();

        Shop::create($requestData);

        Session::flash('flash_message', 'Shop added!');

        return redirect('admin/shops');
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
        $shop = Shop::findOrFail($id);

        return view('admin.shops.show', compact('newsflash'));
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
        $shop = Shop::findOrFail($id);

        return view('admin.shops.edit', compact('shop'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();

        $shop = Shop::findOrFail($id);
        $shop->update($requestData);

        Session::flash('flash_message', 'Shop updated!');

        return redirect('admin/shops');
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
        Shop::destroy($id);

        Session::flash('flash_message', 'Shop deleted!');

        return redirect('admin/shops');
    }
}
