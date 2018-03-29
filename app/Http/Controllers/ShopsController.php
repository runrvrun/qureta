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
        $kaos = Shop::where('category','kaos')->orderBy('updated_at','desc')->take(4)->get();
        $mug = Shop::where('category','mug')->orderBy('updated_at','desc')->take(4)->get();
        $tas = Shop::where('category','tas')->orderBy('updated_at','desc')->take(4)->get();
        $bantal = Shop::where('category','bantal')->orderBy('updated_at','desc')->take(4)->get();
        $lainnya = Shop::where('category','lainnya')->orderBy('updated_at','desc')->take(4)->get();
        return view('pages.shop', compact('kaos','mug','tas','bantal','lainnya'));
    }
    public function indexcategory($category) {
        $shop = Shop::where('category',$category)->orderBy('updated_at','desc')->paginate(16);
        return view('pages.shopcategory', compact('shop'));
    }

}
