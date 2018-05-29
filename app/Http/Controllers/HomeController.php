<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post_metum;
use App\Post;
use App\Buqu;
use App\Banner;
use App\Course;
use App\Newsflash;
use Carbon;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        ///get last 4 featured post for each category
        //aktual
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '1');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[0] = $post_metum[4];
        unset($post_metum[4]);
        $aktual = $post_metum;
        //fiksi
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '2');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[1] = $post_metum[4];
        unset($post_metum[4]);
        $fiksi = $post_metum;
        //inspiratif
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '3');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[2] = $post_metum[4];
        unset($post_metum[4]);
        $inspiratif = $post_metum;
        //jenaka
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '4');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[3] = $post_metum[4];
        unset($post_metum[4]);
        $jenaka = $post_metum;
        //kiat
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '5');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[4] = $post_metum[4];
        unset($post_metum[4]);
        $kiat = $post_metum;
        //populer
        $post_metum = Post::with('post_authors')->where('post_status', 'publish')->where('hide', 0)->where('published_at', '>=', Carbon::yesterday())->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('view_count', 'DESC')->take(3)->get();
        unset($post_metum[3]);
        $populer_today = $post_metum;
        //populer now
        $limit=12;
        $posts = get_popular_post($limit);

        ///get most popular buqus
         $buqus = Buqu::where('featured_at','>',0)->orderBy('featured_at', 'DESC')->take($limit)->get();
        ///get latest kuliah qureta
        $kuliah = Course::with('course_users')->orderBy('updated_at','DESC')->where('enrolls_start','<=',Carbon::now())->take(4)->get();
        ///get newsflash
        $newsflash = Newsflash::inRandomOrder()->first();

        return view('pages.home', compact('slides', 'aktual', 'fiksi', 'inspiratif', 'jenaka', 'kiat', 'posts', 'buqus','kuliah','newsflash','populer_today'));
    }

public function hometest() {
        ///get last 4 featured post for each category
        //aktual
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '1');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[0] = $post_metum[4];
        unset($post_metum[4]);
        $aktual = $post_metum;
        //fiksi
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '2');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[1] = $post_metum[4];
        unset($post_metum[4]);
        $fiksi = $post_metum;
        //inspiratif
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '3');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[2] = $post_metum[4];
        unset($post_metum[4]);
        $inspiratif = $post_metum;
        //jenaka
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '4');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[3] = $post_metum[4];
        unset($post_metum[4]);
        $jenaka = $post_metum;
        //kiat
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '5');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->take(5)->get();
        $slides[4] = $post_metum[4];
        unset($post_metum[4]);
        $kiat = $post_metum;
        //populer
        $limit=12;
        $posts = get_popular_post($limit);


        ///get most popular buqus
         $buqus = Buqu::where('featured_at','>',0)->orderBy('featured_at', 'DESC')->take($limit)->get();


        return view('pages.hometest', compact('slides', 'aktual', 'fiksi', 'inspiratif', 'jenaka', 'kiat', 'posts', 'buqus'));
    }


}
