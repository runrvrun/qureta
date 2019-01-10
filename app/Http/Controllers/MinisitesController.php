<?php

namespace App\Http\Controllers;

use App\Post;
use App\Post_metum;
use Illuminate\Support\Facades\Redirect;
use Carbon;

class MinisitesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ceritakertas() {
      $pagetitle = 'Cerita Tentang Kertas';
      $post_metum = Post_metum::where('meta_name', '=', 'post_fcategory')->where('meta_value', '=', '12')->orderBy('created_at', 'DESC')->pluck('post_id');
      $posts = Post::with('post_authors')->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->whereIn('id', $post_metum)->orderBy('published_at', 'DESC')->paginate(9);

      return view('minisites.ceritakertas', compact('pagetitle', 'posts'));
    }

}
