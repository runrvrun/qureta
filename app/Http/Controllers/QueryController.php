<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use App\Buqu;
use Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class QueryController extends Controller {

      public function __construct()
      {
        date_default_timezone_set('Asia/Jakarta');
      }
    public function search(Request $request) {
        if ($request->input('gototopik')) {
            $q = $request->input('gototopik');

            return redirect('/topik/' . $q);
        }

        if ($request->input('q')) {
            $sp = $request->input('sp');
            $q = $request->input('q');

            if ($sp == 'artikel') {
            	$pagetitle = 'Hasil Pencarian Artikel: ' . $q .' <br/><small> <a href="' . url('/cari?sp=artikel&q='.$q) . '">Artikel </a> | <a href="' . url('/cari?sp=penulis&q='.$q) . '">Penulis </a> | <a href="' . url('/cari?sp=buqu&q='.$q) . '">Buqu </a></small>';

                //$posts = Post::with('post_authors')->where('post_status', 'publish')->where('published_at', '<=', Carbon::now())
                //        ->whereRaw("MATCH (post_title, post_content) AGAINST ('$q')")->paginate (20);
                $posts = Post::with('post_authors')->where('post_status', 'publish')->where('published_at', '<=', Carbon::now())
                        ->search($q)->paginate(20);

                $querystring['q'] = $q;
                $querystring['sp'] = $sp;

                return view('pages.artikel', compact('pagetitle', 'posts', 'querystring'));
            } elseif ($sp == 'penulis') {
            	$pagetitle = 'Hasil Pencarian Penulis: ' . $q .' <br/><small> <a href="' . url('/cari?sp=artikel&q='.$q) . '">Artikel </a> | <a href="' . url('/cari?sp=penulis&q='.$q) . '">Penulis </a> | <a href="' . url('/cari?sp=buqu&q='.$q) . '">Buqu </a></small>';
                $users = User::where('status',1)->where(function ($query) use ($q) {
                    $query->where('username', 'like', '%' . $q . '%')->orWhere('name', 'like', '%' . $q . '%');
                })->orderBy('id', 'DESC')->paginate(24);
                $querystring['q'] = $q;
                $querystring['sp'] = $sp;

                return view('pages.penulis', compact('pagetitle', 'users', 'querystring'));
            } elseif ($sp == 'buqu') {
            	$pagetitle = 'Hasil Pencarian Buqu: ' . $q .' <br/><small> <a href="' . url('/cari?sp=artikel&q='.$q) . '">Artikel </a> | <a href="' . url('/cari?sp=penulis&q='.$q) . '">Penulis </a> | <a href="' . url('/cari?sp=buqu&q='.$q) . '">Buqu </a></small>';
                $buqus = Buqu::where('buqu_title', 'like', '%' . $q . '%')->orderBy('id', 'DESC')->paginate(20);
                $querystring['q'] = $q;
                $querystring['sp'] = $sp;

                return view('pages.buqu', compact('pagetitle', 'buqus', 'querystring'));
            } else {
            	$pagetitle = 'Hasil Pencarian Artikel: ' . $q .' <br/><small> <a href="' . url('/cari?sp=artikel&q='.$q) . '">Artikel </a> | <a href="' . url('/cari?sp=penulis&q='.$q) . '">Penulis </a> | <a href="' . url('/cari?sp=buqu&q='.$q) . '">Buqu </a></small>';
                $posts = Post::with('post_authors')->where('post_status', 'publish')->where('post_title', 'like', '%' . $q . '%')->orWhere('post_content', 'like', '%' . $q . '%')->orderBy('id', 'DESC')->paginate(12);
                $querystring['q'] = $q;
                $querystring['sp'] = $sp;

                return view('pages.artikel', compact('pagetitle', 'posts', 'querystring'));
            }
        }
    }

}
