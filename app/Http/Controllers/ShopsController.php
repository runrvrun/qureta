<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Shop;
use Illuminate\Support\Facades\Redirect;
use Carbon;

class ShopsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $kaos = Shop::where('category','kaos')->get();
        $mug = Shop::where('category','mug')->get();
        $lainnya = Shop::where('category','lainnya')->get();
        return view('pages.shop', compact('kaos','mug','lainnya'));
    }

}
