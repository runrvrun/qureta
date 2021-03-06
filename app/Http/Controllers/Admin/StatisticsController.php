<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post_metum;
use Illuminate\Http\Request;
use Session;
use DB;
use Carbon;

class StatisticsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $pagetitle = 'Statistik Topik';
        /*$categories = Category::select(DB::raw('category_title,(select count(1) from post_meta where meta_name = \'post_category\' AND meta_value = categories.id) counter,
(select sum(view_count) from posts left join post_meta on posts.id=post_meta.post_id where meta_name = \'post_category\' AND meta_value = categories.id) viewcounter'))->orderBy('counter', 'DESC')->distinct()->paginate(50);*/
        $categories = Post_metum::select(DB::raw('DISTINCT category_title, category_slug, count(1) counter, sum(view_count) viewcounter'))
                ->leftJoin('posts', 'post_meta.post_id', '=', 'posts.id')
                ->leftJoin('categories', 'post_meta.meta_value', '=', 'categories.id')
                ->where('meta_name','post_category')
                ->where('post_status','publish')->where('hide','0')->where('published_at', '<=', Carbon::now())
                ->groupBy('category_title')
                ->orderBy('counter', 'DESC')->paginate(50);

        return view('admin.statistics.topic', compact('categories','pagetitle'));
    }

    public function search(Request $request) {
        if (isset($request->startdate) && !empty($request->startdate)) {
            $startdate = $request->startdate;
        } else {
            $startdate = '1900-01-01';
        }

        if (isset($request->enddate) && !empty($request->startdate)) {
            $enddate = $request->enddate;
        } else {
            $enddate = '9999-01-01';
        }

        $startdatetitle = new Carbon($startdate);
        $enddatetitle = new Carbon($enddate);

        $pagetitle = 'Statistik Topik ('.$startdatetitle->format('j M Y').' - '.$enddatetitle->format('j M Y').')';

        $categories = Post_metum::select(DB::raw('DISTINCT category_title, count(1) counter, sum(view_count) viewcounter'))
                ->leftJoin('posts', 'post_meta.post_id', '=', 'posts.id')
                ->leftJoin('categories', 'post_meta.meta_value', '=', 'categories.id')
                ->where('meta_name','post_category')
                ->where('post_status','publish')->where('hide','0')->where('published_at', '<=', Carbon::now())
                ->whereBetween('posts.created_at',[$startdate,$enddate])
                ->groupBy('category_title')
                ->orderBy('counter', 'DESC')->paginate(50);

        return view('admin.statistics.topic', compact('categories','pagetitle'));
    }

}
