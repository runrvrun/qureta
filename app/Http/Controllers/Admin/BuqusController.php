<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Buqu;
use Illuminate\Http\Request;
use Session;
use Carbon;

class BuqusController extends Controller {

    public function __construct()
    {
      date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $buqus = Buqu::with('buqu_authors', 'buqu_posts')->orderBy('id', 'DESC')->paginate(25);

        return view('admin.buqus.index', compact('buqus'));
    }
}
