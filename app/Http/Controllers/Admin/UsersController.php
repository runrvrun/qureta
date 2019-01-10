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
use Yajra\Datatables\Datatables;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $totaluser = User::count();
        $penulis = User::where('post_count','>',0)->orderBy('post_count','DESC')->orderBy('username')->paginate(25, ['*']);
        $partner = User::where('role','partner')->orderBy('role','ASC')->orderBy('username','ASC')->paginate(25, ['*']);
        $premium = User::where('role','premium')->orderBy('role','ASC')->orderBy('username','ASC')->paginate(25, ['*']);
        $admin = User::where('role','admin')->orWhere('role','editor')->orderBy('role','ASC')->orderBy('username','ASC')->paginate(25, ['*'], 'adminpage');

        return view('admin.users.index_dt', compact('totaluser','penulis','admin','partner','premium'));
    }

    public function alluserdata() {
      return Datatables::of(User::select('id','username','name','post_count','email','phone_number'))
      ->addColumn('action', function ($item) {
               return view('admin.users.actions', compact('item'))->render();
          })->make(true);
    }


    public function search(Request $request) {
        $users = User::orderBy('username')->where('username', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->paginate(25, ['*'], 'page');
        $penulis = User::where('post_count','>',0)->where('username', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->orderBy('post_count','DESC')->orderBy('username')->paginate(25, ['*'], 'penulispage');
        $admin = User::where('role','admin')->orWhere('role','editor')->orderBy('role','ASC')->orderBy('username','ASC')->paginate(25, ['*'], 'adminpage');
        $partner = User::where('role','partner')->orderBy('role','ASC')->orderBy('username','ASC')->paginate(25, ['*'], 'adminpage');
         $premium = User::where('role','premium')->orderBy('role','ASC')->orderBy('username','ASC')->paginate(25, ['*'], 'adminpage');

        $querystring['search']=$request->search;
        return view('admin.users.index', compact('users','penulis','partner','premium','admin','querystring'));
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

    public function autoComplete(Request $request) {
        $query = $request->get('term','');

        $user=User::where('name','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($user as $users) {
                $data[]=array('value'=>$users->name,'id'=>$users->id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
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
