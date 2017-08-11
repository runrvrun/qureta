<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Session;
use Hash;
use Carbon;
use DB;
use App\Post;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $users = User::orderBy('username')->paginate(25, ['*'], 'page');        
        $penulis = User::where('post_count','>',0)->orderBy('post_count','DESC')->orderBy('username')->paginate(25, ['*'], 'penulispage');        
        $admin = User::orderBy('username')->where('role','admin')->orWhere('role','editor')->orderBy('role','ASC')->orderBy('username','ASC')->paginate(25, ['*'], 'adminpage');        

        return view('admin.users.index', compact('users','penulis','admin'));
    }

    public function search(Request $request) {
        
        $users = User::orderBy('username')->where('username', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->paginate(25);        
        $penulis = User::where('post_count','>',0)->where('username', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->orderBy('post_count','DESC')->orderBy('username')->paginate(25, ['*'], 'penulispage');        
                
        $querystring['search']=$request->search;
        return view('admin.users.index', compact('users','penulis','querystring'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        //return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $requestData = $request->all();

        User::create($requestData);

        Session::flash('flash_message', 'User added!');

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
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

        $requestData = $request->all();

        if (!isset($requestData['banned'])) {
            $requestData['banned_until'] = '1990-01-01 00:00:00';
        } else {
            $requestData['banned_until'] = Carbon::parse($requestData['banned_until'])->format('Y-m-d H:i:s');
        }

        $user = User::findOrFail($id);
        $user->update($requestData);

        Session::flash('flash_message', 'User updated!');

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        User::destroy($id);

        Session::flash('flash_message', 'User deleted!');

        return redirect('admin/users');
    }

    public function changeform($userid) {
        return view('admin.users.changepassword', compact('userid'));
    }

    public function changepassword(Request $request) {
        $userid = $request->userid;
        $this->validate($request, [
            'newpassword' => 'required|confirmed|min:8'
        ]);

        $user = User::find($userid);
        $user->fill([
            'password' => Hash::make($request->newpassword)
        ])->save();
        
        Session::flash('flash_message', 'Password changed');

        return redirect('admin/users');
    }

}
