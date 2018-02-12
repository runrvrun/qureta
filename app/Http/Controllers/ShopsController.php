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
        $kaos = Shop::where('category','kaos')->orderBy('created_at','desc')->get();
        $mug = Shop::where('category','mug')->orderBy('created_at','desc')->get();
        $tas = Shop::where('category','tas')->orderBy('created_at','desc')->get();
        $bantal = Shop::where('category','bantal')->orderBy('created_at','desc')->get();
        $lainnya = Shop::where('category','lainnya')->orderBy('created_at','desc')->get();
        return view('pages.shop', compact('kaos','mug','tas','bantal','lainnya'));
    }

}
