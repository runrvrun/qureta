<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Workshop;
use App\Workshop_post;
use App\Workshop_files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Session;
use Carbon;
use DB;
use HTML;
use Validator;
use Hash;
use Mail;

class WorkshopController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($workshopid = null) {
         if (Auth::check()) {
            $pagetitle = 'Workshop';
         $workshops = Workshop::where('workshop_startdate','<=',Carbon::now()->format('Y-m-d H:i:s'))->where('workshop_enddate','>=',Carbon::now()->format('Y-m-d H:i:s'))->paginate(25);
            $user_id = Auth::user()->id;
           $cek_file = Workshop_files::where('user_id',$user_id);//->whereNotNull('workshop_id',$workshopid);
            return view('pages.workshop', compact('pagetitle','workshops','user_id','cek_file'));
        }
        else{
         $pagetitle = 'Workshop';
	$workshops = Workshop::where('workshop_startdate','<=',Carbon::now()->format('Y-m-d H:i:s'))->where('workshop_enddate','>=',Carbon::now()->format('Y-m-d H:i:s'))->paginate(25);
         return view('pages.workshop', compact('pagetitle','workshops'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
         $this->validate($request, [
                'name' => 'required',
                'phone_number' => 'required'
            ]);
        $input = $request->all();
        $email = $request['email'];
         $name = $request['name'];
        $files = Input::file('files');
        $file_count = count($files);
        $uploadcount = 0;
    
        foreach($files as $file) 
        {
              $rules = array('file' => 'required|max:10000|mimes:doc,docx,pdf');
              $rules2 = array('email' => 'unique:workshop_members,email'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
              $validator = Validator::make(array('file'=> $file), $rules);
              $validator2 = Validator::make(array('email'=> $email), $rules2);

              if($validator->passes() && $validator2->passes())
                {
                    $destinationPath = 'uploads/tulisan';
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);
                    $uploadcount ++;
                    $input['files'] = $filename;
                    $input['original_filename'] = $filename;
                    $input['filename'] = $file->getFilename().'.'.$filename;
                    
                    Workshop_files::create($input);
                }
                elseif($validator->passes() && $validator2->fails())
                {
                     Session::flash('flash_message', 'Email Ini Sudah Terdaftar');
                   return Redirect::back()->withInput(Input::all());
                }


                else
                {
                    Session::flash('flash_message', 'Silakan Upload File .doc, .docx, atau .pdf');
                   return Redirect::back()->withInput(Input::all());
                }
        }
        
        if($uploadcount == $file_count)
        {
            Workshop_post::create($input);
            //$subject = 'Pendaftaran Workshop Qureta';
             //Mail::send(['html' => 'auth.workshops.registration'], ['email' => $email, 'name' => $name], function($message) use ($email, $subject, $email,$name) {
               // $message->to($email, $email)->subject($subject);
            //});
            Session::flash('flash_message', 'Pendaftaran Workshop Berhasil!');
            return redirect('/workshop');
        }
        else
        {
             Session::flash('flash_message', 'Pendaftaran Gagal! Silakan Upload File');
            return redirect('/workshop')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
   public function edit($workshop_id, $id) {
      // $query = ['workshop_id' => $workshop_id, 'user_id' => $id]->value('id');
        $workshop = Workshop_post::where('workshop_id',$workshop_id)->where('user_id',$id)->first();
        
        return view('posts.editworkshop', compact('workshop'));
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
        $this->validate($request, [
                'name' => 'required',
                'phone_number' => 'required'
            ]);
        $input = $request->all();
        $user_id =  Auth::user()->id;
        $email = $request['email'];
         $name = $request['name'];
        $files = Input::file('files');
        $file_count = count($files);
        $uploadcount = 0;
    
        foreach($files as $file) 
        {
              $rules = array('file' => 'required|max:10000|mimes:doc,docx,pdf');
              $rules2 = array('email' => 'unique:workshop_members,email'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
              $validator = Validator::make(array('file'=> $file), $rules);
              $validator2 = Validator::make(array('email'=> $email), $rules2);

              if($validator->passes())
                {
                    $destinationPath = 'uploads/tulisan';
                    $filename = $file->getClientOriginalName();
                    $upload_success = $file->move($destinationPath, $filename);
                    $uploadcount ++;
                    $input['files'] = $filename;
                    $input['original_filename'] = $filename;
                    $input['filename'] = $file->getFilename().'.'.$filename;
                    
                    Workshop_files::create($input);
                }
                
        }
        
       
            $workshop = Workshop_post::findOrFail($id);
            $workshop->update($input);
            //$subject = 'Pendaftaran Workshop Qureta';
             //Mail::send(['html' => 'auth.workshops.registration'], ['email' => $email, 'name' => $name], function($message) use ($email, $subject, $email,$name) {
               // $message->to($email, $email)->subject($subject);
            //});
            Session::flash('flash_message', 'Update Berhasil!');
            return redirect('/workshop');
        
       
    }

    public function peserta($id) {
        if(Auth::check()){
            $workshop = Workshop_post::where('workshop_id',$id)->get();
            
            return view('pages.pesertaWorkshop', compact('workshop'));
        }
         else{
            return redirect('/login');
            
        }
    }

    public function create_peserta() {
        return view('admin.workshops.kirimtulisanworkshop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
       
    }

}
