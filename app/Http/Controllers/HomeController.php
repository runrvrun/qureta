<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post_metum;
use App\Post;
use App\Buqu;
use App\Banner;
use App\Course;
use App\Newsflash;
use App\Competition;
use Carbon;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      date_default_timezone_set('Asia/Jakarta');
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
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(7)->get();
        $slides[3] = $post_metum[6];
        unset($post_metum[6]);
        $jenaka = $post_metum;
        //kiat
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '5');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(9)->get();
        $slides[4] = $post_metum[8];
        unset($post_metum[8]);
        $kiat = $post_metum;
        //fiksi
        $fiksi = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '2');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('published_at', 'DESC')->take(3)->get();
        //lombaesai
        $lombaesai = Post::where('post_author',7162)->orderBy('published_at','DESC')->take(4)->get();
        //populer, ambil hanya yang featured_category
        $post_metum = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category');
                })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '>=', Carbon::yesterday())->where('published_at', '<=', Carbon::now())->orderBy('sticky', 'DESC')->orderBy('view_count', 'DESC')->take(4)->get();
        //kalau 2 hari ini kurang dari 3, ambil lagi sampai 3 hari lalu
        if(count($post_metum) < 4 ){
          $post_metum2 = Post::with('post_authors')->whereHas('post_metum', function($query) {
                      $query->where('meta_name', 'post_featured_category');
                  })->where('post_status', 'publish')->where('hide', 0)->where('published_at', '>=', Carbon::now()->subDays(300))->where('published_at', '<', Carbon::yesterday())->orderBy('sticky', 'DESC')->orderBy('view_count', 'DESC')->take(4)->get();
        }
        if(!empty($post_metum2)){
        $post_metum = $post_metum->merge($post_metum2);
        }
        //ambil 3, delete sisanya
        $post_metum->forget(4);$post_metum->forget(5);$post_metum->forget(6);
        $populer_today = $post_metum;
        //populer now
        $limit=12;
        $posts = get_popular_post($limit);

        //penulis terfavorit
        $terfavorit = DB::select("SELECT u.id, post_author, sum(view_count) total_view, u.name, u.username, u.user_image, u.role from posts p
INNER JOIN users u ON p.post_author = u.id
WHERE p.post_status = 'publish' AND p.hide = 0 AND p.published_at < now() AND u.status=1
group by post_author, u.name, u.username, u.user_image, u.role  order by sum(view_count) desc limit 4");

        //penulis terproduktif
        $terproduktif = DB::select("SELECT u.id, post_author, count(p.id) total_post, u.name, u.username, u.user_image, u.role
FROM posts p INNER JOIN users u ON p.post_author = u.id
WHERE p.post_status = 'publish' AND p.hide = 0 AND p.published_at < now() AND u.status=1
GROUP BY post_author, u.name, u.username, u.user_image, u.role ORDER BY count(p.id) desc limit 4");

        ///get most popular buqus
        $buqus = Buqu::where('featured_at','>',0)->orderBy('featured_at', 'DESC')->take($limit)->get();
        ///get latest kuliah qureta
        $kuliah = Course::with('course_users')->orderBy('updated_at','DESC')->where('enrolls_start','<=',Carbon::now())->take(4)->get();
        ///get newsflash
        $newsflash = Newsflash::inRandomOrder()->first();

        return view('pages.home', compact('slides', 'aktual', 'fiksi', 'inspiratif', 'jenaka', 'kiat', 'fiksi', 'lombaesai', 'posts', 'buqus','kuliah','newsflash','populer_today','terfavorit','terproduktif'));
    }



}
