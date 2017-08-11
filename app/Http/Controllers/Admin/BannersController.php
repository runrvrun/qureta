<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Banner;
use Illuminate\Http\Request;
use Session;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banners = Banner::paginate(25);

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.banners.create');
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
        
if ($request->hasFile('image')) {
    
    $uploadPath = public_path('/uploads/banner/');

    $extension = $request->file('image')->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . '.' . $extension;

    $request->file('image')->move($uploadPath, $fileName);
    $requestData['image'] = $fileName;
}

        Banner::create($requestData);

        Session::flash('flash_message', 'Banner added!');

        return redirect('admin/banners');
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.show', compact('banner'));
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
        $banner = Banner::findOrFail($id);

        return view('admin.banners.edit', compact('banner'));
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

if ($request->hasFile('image')) {
    $uploadPath = public_path('/uploads/banner/');

    $extension = $request->file('image')->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . '.' . $extension;

    $request->file('image')->move($uploadPath, $fileName);
    $requestData['image'] = $fileName;
}

        $banner = Banner::findOrFail($id);
        $banner->update($requestData);

        Session::flash('flash_message', 'Banner updated!');

        return redirect('admin/banners');
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
        Banner::destroy($id);

        Session::flash('flash_message', 'Banner deleted!');

        return redirect('admin/banners');
    }
}
