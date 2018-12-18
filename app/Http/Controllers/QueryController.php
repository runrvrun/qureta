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
            $q = $request->input('q');
        	  $pagetitle = 'Hasil Pencarian: ' . $q ;

            $posts = Post::with('post_authors')->where('post_status', 'publish')->where('published_at', '<=', Carbon::now())
                    ->search($q)->take(50)->get();

            $users = User::where('status',1)->where(function ($query) use ($q) {
                $query->where('username', 'like', '%' . $q . '%')->orWhere('name', 'like', '%' . $q . '%');
            })->orderBy('id', 'DESC')->take(50)->get();
            $querystring['q'] = $q;

            return view('pages.searchresult', compact('pagetitle', 'posts', 'users', 'querystring'));
        }
    }

}
