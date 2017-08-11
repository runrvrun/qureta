<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;

class CommentsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        
    }

    public function export_wxr() {        
        return view('pages.export_wxr');
    }
}