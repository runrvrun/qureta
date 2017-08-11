<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use Illuminate\Http\Request;
use Session;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $profiles = Profile::paginate(25);

        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('profiles.create');
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
        

if ($request->hasFile('profile_header_image')) {
    $uploadPath = public_path('/uploads/');

    $extension = $request->file('profile_header_image')->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . '.' . $extension;

    $request->file('profile_header_image')->move($uploadPath, $fileName);
    $requestData['profile_header_image'] = $fileName;
}

        Profile::create($requestData);

        Session::flash('flash_message', 'Profile added!');

        return redirect('profiles');
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
        $profile = Profile::findOrFail($id);

        return view('profiles.show', compact('profile'));
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
        $profile = Profile::findOrFail($id);

        return view('profiles.edit', compact('profile'));
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
        

if ($request->hasFile('profile_header_image')) {
    $uploadPath = public_path('/uploads/');

    $extension = $request->file('profile_header_image')->getClientOriginalExtension();
    $fileName = rand(11111, 99999) . '.' . $extension;

    $request->file('profile_header_image')->move($uploadPath, $fileName);
    $requestData['profile_header_image'] = $fileName;
}

        $profile = Profile::findOrFail($id);
        $profile->update($requestData);

        Session::flash('flash_message', 'Profile updated!');

        return redirect('profiles');
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
        Profile::destroy($id);

        Session::flash('flash_message', 'Profile deleted!');

        return redirect('profiles');
    }
}
