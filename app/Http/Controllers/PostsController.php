<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post_metum;
use App\Post;
use App\Buqus;
use App\Category;
use App\Featured_category;
use App\Competition;
use App\Workshop;
use App\Competition_post;
use App\User;
use App\Followers;
use App\Mail\PostReturned;
use App\Mail\PostPublished;
use Auth;
use Illuminate\Http\Request;
use Session;
use Image;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cookie;
use Carbon;
use HTML;
use App\Notifications\NewPost;
use App\Notifications\PublishPost;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Validation\Rule;
use Analytics;
use Counter;
use Mail;

class PostsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        //$posts = Post::paginate(25);
        //return view('posts.index', compact('posts'));
        return redirect('/post');
    }

    public function indexcategories() {
        $posts = Post::paginate(25);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('posts.create');
    }

    public function kirimtulisan() {
        if (is_banned(Auth::user()->id)) {
            Auth::logout();
            return redirect('/login');
        }
	$draftcount = Post::where('post_author', Auth::user()->id)->where('post_status', '=', 'draft')->count();
        return view('posts.kirimtulisan',compact('draftcount'));
    }

    public function kirimtulisanlomba($lombaid) {
        if (is_banned(Auth::user()->id)) {
            Auth::logout();
            return redirect('/login');
        }
        $draftcount = 0;
        $lomba = Competition::findOrFail($lombaid);
        return view('posts.kirimtulisan', compact('lomba','draftcount'));
    }

    public function kirimtulisanworkshop($workshopid) {
        if (is_banned(Auth::user()->id)) {
            Auth::logout();
            return redirect('/login');
        }
        $workshop = Workshop::findOrFail($workshopid);
        return view('posts.kirimtulisanworkshop', compact('workshop'));
    }

    public function admin_kirimtulisanworkshop($workshopid) {
        if (is_banned(Auth::user()->id)) {
            Auth::logout();
            return redirect('/login');
        }
        $workshop = Workshop::findOrFail($workshopid);
        return view('posts.adminkirimtulisanworkshop', compact('workshop'));
    }

    public function autosave(Request $request) {
        $post_id = $request['id'];
        unset($request['id']);
        $curtime = Carbon::now()->format('j M Y H:i:s');
        if ($post_id > 0) {
            //update
            $this->validate($request, [
                'post_title' => 'required|regex:/^([0-9a-zA-Z].*+)$/'
            ]);
            $requestData = $request->all();
            $requestData['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $requestData['updated_by'] = Auth::user()->username;

            $post = Post::findOrFail($post_id);
            $post->update($requestData);
            return response()->json(['responseText' => 'Update Success', 'postid' => $post_id, 'lastsaved' => $curtime], 200);
        } else {
            //store
            $this->validate($request, [
                'post_title' => 'required'
            ]);
            $requestData = $request->all();
            $requestData['created_at'] = Carbon::now();
            $requestData['created_by'] = Auth::user()->username;

            $post = Post::create($requestData);
            $post_id = $post->id;
            return response()->json(['responseText' => 'Store Success!', 'postid' => $post_id, 'lastsaved' => $curtime], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        if (is_banned(Auth::user()->id)) {
            Auth::logout();
            return redirect('/login');
        }
        //get post category
        $category_id = $request['post_category'];
        unset($request['post_category']);
        //get post featured category
        $fcategory_id = $request['post_fcategory'];
        unset($request['post_fcategory']);

        $this->validate($request, [
            'post_title' => 'required|regex:/^([0-9a-zA-Z].*+)$/',
                // 'post_image' => 'required|mimes:png,jpeg,jpg',
        ]);
        $requestData = $request->all();

        if (isset($request->savepending)) {
            $requestData['post_status'] = 'pending';
            unset($requestData['published_at']);
        } elseif (isset($request->savedraft)) {
            $requestData['post_status'] = 'draft';
            unset($requestData['published_at']);
        }

        if ($request->hasFile('post_image')) {
            $uploadPath = public_path('/uploads/post/');
            $uploadThumbPath = public_path('/uploads/post/thumb/');

            $extension = 'jpg';
            $fileName = rand(11111, 99999) . '_'. rand(11111, 99999) . '.' . $extension;

            $file = $request->file('post_image');
            Image::make($file->getRealPath())->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 75)->save($uploadThumbPath . $fileName);
            Image::make($file->getRealPath())->resize(653, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();

            //$request->file('buqu_image')->move($uploadPath, $fileName);
            $requestData['post_image'] = $fileName;
        }

        $post = Post::create($requestData);
        $post_id = $post->id;

        $requestCat = ['post_id' => $post_id, 'meta_name' => 'post_category', 'meta_value' => $category_id];
        Post_metum::create($requestCat);
        if ($fcategory_id > 0) {
            $requestFCat = ['post_id' => $post_id, 'meta_name' => 'post_fcategory', 'meta_value' => $fcategory_id];
            Post_metum::create($requestFCat);
        }

        if (isset($request->post_competition)) {
            $compost = ['post_id' => $post_id, 'competition_id' => $request->post_competition];
            \App\Competition_post::create($compost);
        }

        if (isset($request->savepending)) {
            Session::flash('flash_message', 'Naskah dikirim ke editor. ' . HTML::link('/post/' . $post->post_slug, 'Lihat tulisan'));
            return view('posts.thankyou', compact('addmsg'));
        } else {
            Session::flash('flash_message', 'Naskah disimpan. ' . HTML::link('/post/' . $post->post_slug, 'Lihat tulisan'));
            return redirect('/edit-tulisan/' . $post->post_slug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    public function showpermalink($permalink) {

        $limit = 10;
        $post = Post::where('post_slug', '=', $permalink)->first();
        $populer = get_popular_post($limit);

        if ($post == null)
            abort('404');

        if ($post->post_status === 'publish' || (Auth::check() && $post->post_author == Auth::user()->id) || (Auth::user() && (Auth::user()->role == 'admin' || Auth::user()->role == 'editor'))) {
            $categoryid = Post_metum::where('meta_name', 'post_category')->where('post_id', $post->id)->first();
	    $category = Category::where('id',$categoryid->meta_value)->first();

            //counter: manual
            //$requestData['view_count'] = $post->view_count + 1;///increment view count dipindah ke frontend pakai jquery ajax. single.php
            //counter: Kryptonit3
            Counter::count('post', $post->id);
            //hit google analytics once every hour, so api call limit won't reached
            if((Carbon::parse($post->created_at)->diffInSeconds(Carbon::now()) % 60) < 30 ){
	    try {
                //counter: google analytics
                $startDate = $post->created_at;
                //$endDate = Carbon::now();
                $endDate = Carbon::createFromDate(date("Y"), date("m"), date("d"))->addDays(rand(1,99));
                $metrics = 'ga%3Apageviews,ga%3Avisits';
                $others = array('dimensions' => 'ga%3ApagePath', 'filters' => 'ga%3ApagePath==/post/' . $post->post_slug);
                $analytics = Analytics::performQuery($startDate, $endDate, $metrics, $others);
	        if($analytics->rows[0][1] > $post->view_count){
                    //update view count with count from analytics
                    $post->view_count = $analytics->rows[0][1];
                    //update the counter in database too
                    $requestData['view_count'] = $analytics->rows[0][1];
                    $post->update($requestData);
                }
            }catch (\Exception $e) {
                //return $e->getMessage();
            }
        }

            return view('pages.single', compact('post', 'buqus', 'related', 'category', 'populer'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $post = Post::findOrFail($id);
        if ($post->post_author !== Auth::user()->id) {
            return redirect('/');
        }

        return view('posts.edit', compact('post'));
    }

    public function edittulisan($permalink) {
        if (is_banned(Auth::user()->id)) {
            Auth::logout();
            return redirect('/login');
        }
        $post = Post::where('post_slug', $permalink)->first();
        if ($post) {
            $category = Post_metum::where('post_id', $post->id)->where('meta_name', 'post_category')->pluck('meta_value')->first();
            $fcategory = Post_metum::where('post_id', $post->id)->where('meta_name', 'post_featured_category')->pluck('meta_value')->first();
            $competition = Competition_post::with('competition')->where('post_id', $post->id)->where('competition_id','>',0)->first();
            if (Auth::check()) {
                if ($post->post_author == Auth::user()->id || (Auth::user()->role === 'admin' || Auth::user()->role === 'editor')) {
                    return view('posts.edittulisan', compact('post', 'category', 'fcategory', 'competition'));
                }
            } else {
                return redirect('/');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {
        if (is_banned(Auth::user()->id)) {
            Auth::logout();
            return redirect('/login');
        }
        $this->validate($request, [
            'post_title' => 'required|regex:/^([0-9a-zA-Z].*+)$/',
                // 'post_image' => 'required|mimes:png,jpeg,jpg',
        ]);

        if (isset($request->post_slug)) {
            $this->validate($request, [
                'post_slug' => 'unique:posts,post_slug,' . $id
            ]);
        }

        $requestData = $request->all();

        if (isset($request->savepublish)) {
            $requestData['post_status'] = 'publish';
            $requestData['published_by'] = Auth::user()->username;
            if (!isset($requestData['published_at'])) {
                $requestData['published_at'] = Carbon::now()->format('Y-m-d H:i:s');
            } else {
                $requestData['published_at'] = Carbon::createFromFormat('d/m/Y H.i', $requestData['published_at'])->format('Y-m-d H:i:s');
            }
        } elseif (isset($request->savepending)) {
            $requestData['post_status'] = 'pending';
            unset($requestData['published_at']);
        } elseif (isset($request->savedraft)) {
            $requestData['post_status'] = 'draft';
            unset($requestData['published_at']);
        } elseif (isset($request->delete)) {
            $requestData['post_status'] = 'delete';
            unset($requestData['published_at']);
        } elseif (isset($request->save)) {
            unset($requestData['post_status']);
            unset($requestData['published_at']);
        } else {
            unset($requestData['post_status']);
            unset($requestData['published_at']);
        }

        //handle checkbox
        if (isset($requestData['hide'])) {
            $requestData['hide'] = 1;
        } else {
            $requestData['hide'] = 0;
        }
        if (isset($requestData['sticky'])) {
            $requestData['sticky'] = 1;
        } else {
            $requestData['sticky'] = 0;
        }
        if (isset($requestData['hide_adsense'])) {
            $requestData['hide_adsense'] = 1;
        } else {
            $requestData['hide_adsense'] = 0;
        }
        if (isset($requestData['require_login'])) {
            $requestData['require_login'] = 1;
        } else {
            $requestData['require_login'] = 0;
        }

        if ($request->hasFile('post_image')) {
            $uploadPath = public_path('/uploads/post/');
            $uploadThumbPath = public_path('/uploads/post/thumb/');

            $extension = 'jpg';
            $fileName = rand(11111, 99999) . '_' . rand(11111, 99999) . '.' . $extension;

            $file = $request->file('post_image');
            Image::make($file->getRealPath())->fit(300, 179)->encode('jpg', 75)->save($uploadThumbPath . $fileName);
            Image::make($file->getRealPath())->fit(653, 373)->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();

            //$request->file('buqu_image')->move($uploadPath, $fileName);
            $requestData['post_image'] = $fileName;
        }

        $requestData['updated_by'] = Auth::user()->username;

        $post = Post::findOrFail($id);
        $post->update($requestData);

        $requestCat = ['post_id' => $post->id, 'meta_name' => 'post_category', 'meta_value' => $request->post_category];
        Post_metum::where('post_id', $post->id)->where('meta_name', 'post_category')->delete();
        Post_metum::create($requestCat);
        ///featured_category
        Post_metum::where('post_id', $post->id)->where('meta_name', 'post_featured_category')->delete();
        if ($request->post_fcategory > 0) {
            $requestFCat = ['post_id' => $post->id, 'meta_name' => 'post_featured_category', 'meta_value' => $request->post_fcategory];
            Post_metum::create($requestFCat);
        }

        ///ikutkan lomba by admin
        Competition_post::where('post_id', $post->id)->delete();
        if ($request->post_competition > 0) {
            $requestCompPost = ['post_id' => $post->id, 'competition_id' => $request->post_competition];
            Competition_post::create($requestCompPost);
        }

        if (isset($request->savepublish)) {
           //send email to user
           $data = [
             'name' => $post->post_authors->name,
             'title' => $requestData['post_title'],
             'slug' => $requestData['post_slug'],
             'message' => $requestData['moderation_message'],
           ];
	 //check if email valid (and not name/id if from facebook)
           if(filter_var($post->post_authors->email, FILTER_VALIDATE_EMAIL )){
           Mail::to($post->post_authors->email)->send(new PostPublished($data));
           }
           //show alert in web
           Session::flash('flash_message', 'Naskah terbit! ' . HTML::link('/post/' . $post->post_slug, 'Lihat tulisan'));
            /* send notification to author */
            $user = User::find($post->post_author);
            \Notification::send($user, new PublishPost($post));
            /* send notification to followers */
            $followers = Followers::where('user_id', $post->post_author)->get();
            foreach ($followers as $f) {
                $user = User::find($f->follower_id);
                \Notification::send($user, new NewPost($post));
            }
        } elseif (isset($request->savepending)) {
            Session::flash('flash_message', 'Naskah dikirim ke editor. ' . HTML::link('/post/' . $post->post_slug, 'Lihat tulisan'));
        } elseif (isset($request->savedraft)) {
            //send message to user
            $thread = Thread::where('subject', 'Moderasi Tulisan: ' . $post->post_title)->orderBy('id', 'DESC')->first();
            if (isset($thread->id)) {
                $thread->activateAllParticipants();

                // Message
                Message::create(
                        [
                            'thread_id' => $thread->id,
                            'user_id' => Auth::user()->id,
                            'body' => '<p><i>Tulisan anda dikembalikan oleh editor dengan pesan: </i> <br/>' . $requestData['moderation_message']
                            . '</p><p>' . HTML::link('/edit-tulisan/' . $post->post_slug, ' Edit Tulisan: ' . $post->post_title, ['class' => 'btn btn-default']) . '</p>',
                        ]
                );
            } else {
                $thread = Thread::create(
                                [
                                    'subject' => 'Moderasi Tulisan: ' . $post->post_title,
                                ]
                );

                // Message
                Message::create(
                        [
                            'thread_id' => $thread->id,
                            'user_id' => Auth::user()->id,
                            'body' => '<p><i>Tulisan anda dikembalikan oleh editor dengan pesan: </i> <br/>' . $requestData['moderation_message']
                            . '</p><p>' . HTML::link('/edit-tulisan/' . $post->post_slug, ' Edit Tulisan: ' . $post->post_title, ['class' => 'btn btn-default']) . '</p>',
                        ]
                );
                // Sender
                Participant::create(
                        [
                            'thread_id' => $thread->id,
                            'user_id' => Auth::user()->id,
                            'last_read' => new Carbon,
                        ]
                );
                // Recipients
                $recipients[0] = $post->post_author;
                $thread->addParticipant($recipients);
            }
            //send email to user
            $data = [
               'name' => $post->post_authors->name,
               'title' => $requestData['post_title'],
               'slug' => $requestData['post_slug'],
               'message' => $requestData['moderation_message'],
             ];
	   //check if email valid (and not name/id if from facebook)
             if(filter_var($post->post_authors->email, FILTER_VALIDATE_EMAIL )){
             Mail::to($post->post_authors->email)->send(new PostReturned($data));
             }
            //show alert in web
            Session::flash('flash_message', 'Naskah dikembalikan ke draft.');
        } elseif (isset($request->delete)) {
            Session::flash('flash_message', 'Naskah dihapus.');
            update_user_post_count($post->post_author);
            return redirect('/tulisanku');
        } else {
            Session::flash('flash_message', 'Naskah disimpan. ' . HTML::link('/post/' . $post->post_slug, 'Lihat tulisan'));
        }
        update_user_post_count($post->post_author);
	
	if (isset($request->savepublish)) {
            return redirect('/admin/pendingposts');
        } elseif (isset($request->savedraft)) {
            return redirect('/admin/pendingposts');
        } else {
            return redirect('/edit-tulisan/' . $post->post_slug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Post::destroy($id);

        Session::flash('flash_message', 'Post deleted!');

        return redirect('posts');
    }

    public function terbaru(Request $request) {
        $pagetitle = 'Artikel Terbaru';
        $posts = Post::with('post_authors')->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->paginate(12);

        //infinite scroll
        if ($request->ajax()) {
           return view('widgets.article_row', compact('posts'));;
        }

        return view('pages.artikel_infinite', compact('pagetitle', 'posts'));
    }

    public function showcategoryposts($permalink, Request $request) {
        $category = Category::where('category_slug', '=', $permalink)->first();
        $pagetitle = 'Topik: ' . $category->category_title;
        $post_metum = Post_metum::where('meta_name', '=', 'post_category')->where('meta_value', '=', $category->id)->orderBy('created_at', 'DESC')->pluck('post_id');
        $posts = Post::with('post_authors')->where('post_status', 'publish')->where('hide', 0)->whereIn('id', $post_metum)->orderBy('published_at', 'DESC')->paginate(12);

        //infinite scroll
        if ($request->ajax()) {
           return view('widgets.article_row', compact('posts'));;
        }

        return view('pages.artikel_infinite', compact('pagetitle', 'posts'));
    }

    public function showsemuatopik() {
        $categories = DB::select("select c.*, pm.post_id, (select post_image from posts where id=pm.post_id) post_image from categories c LEFT JOIN (select meta_value, max(post_id) post_id from post_meta pm INNER JOIN posts p ON pm.post_id=p.id AND post_status='publish' where meta_name='post_category' group by meta_value) pm ON c.id=pm.meta_value order by c.id");

        $pagetitle = 'Semua Topik';

        return view('pages.semua-topik', compact('pagetitle', 'categories'));
    }

    public function pendingposts() {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'editor') {
            $posts = Post::with('post_authors')->where('post_status', 'pending')->paginate(25);

            return view('admin.pendingposts.index', compact('posts'));
        }
    }

    public function hiddenposts() {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'editor') {
            $posts = Post::with('post_authors')->where('hide', '1')->paginate(25);

            return view('admin.pendingposts.index', compact('posts'));
        }
    }

    public function tulisanku($status = 'publish') {
        if (Auth::check()) {
            $posts = Post::where('post_author', Auth::user()->id)->with('post_authors')->where('post_status', '=', $status)->where('post_status', '!=', 'delete')->orderBy('id', 'DESC')->paginate(12);
            $publishcount = Post::where('post_author', Auth::user()->id)->where('post_status', '=', 'publish')->count();
            $pendingcount = Post::where('post_author', Auth::user()->id)->where('post_status', '=', 'pending')->count();
            $draftcount = Post::where('post_author', Auth::user()->id)->where('post_status', '=', 'draft')->count();
            $pagetitle = 'Tulisanku <small> <a href="' . url('/tulisanku/publish') . '">Terbit (' . $publishcount . ')</a> | <a href="' . url('/tulisanku/pending') . '">Moderasi Editor (' . $pendingcount . ')</a> | <a href="' . url('/tulisanku/draft') . '">Draft (' . $draftcount . ')</a> </small>';
            if (count($posts) > 0) {
                return view('pages.artikel_draft', compact('pagetitle', 'posts'));
            } else {
                switch ($status) {
                    case 'publish':
                        $statusname = 'terbit';
                        break;
                    case 'pending':
                        $statusname = 'dimoderasi editor';
                        break;
                    case 'draft':
                        $statusname = 'belum dikirim';
                        break;
                }
                return view('pages.tulisanku_none', compact('pagetitle', 'statusname'));
            }
        } else {
            return Redirect::route('login')->with('message', 'Anda harus login');
        }
    }

    public function populer(Request $request) {
        $pagetitle = 'Artikel Terpopuler';

        $posts = Post::with('post_authors')
            ->where('post_status', 'publish')->where('hide', 0)
            ->where('published_at','<=',Carbon::now())
            ->where('published_at','>=',Carbon::now()->subDays(3))
            ->orderBy('view_count', 'DESC')->paginate(12);

        if($posts->currentPage() == 1){
        $stickypopuler = Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '11');
                })->where('sticky',1)->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->get();
        $posts = $stickypopuler->merge($posts);
        }

        //infinite scroll
        if ($request->ajax()) {
           return view('widgets.article_row', compact('posts'));;
        }

        return view('pages.artikel_infinite', compact('pagetitle', 'posts'));
    }

    public function rekam() {
        if (Auth::check()) {
            $pagetitle = 'Rekam';
            $posts = Post::whereHas('likes', function($query) {
                        $query->where('follower_id', Auth::user()->id);
                    })->with('post_authors')->where('post_status', 'publish')->orderBy('id', 'DESC')->paginate(12);

            return view('pages.artikel', compact('pagetitle', 'posts'));
        } else {
            return Redirect::route('login')->with('message', 'Anda harus login');
        }
    }

    public function jejak() {
        $pagetitle = 'Jejak';

        $cookie = Cookie::get('kryptonit3-counter');

        if (($cookie !== false)) {
            $visitor = $cookie;
            $hashvisitor = hash("SHA256", env('APP_KEY') . $visitor);

            $visitorid = DB::table('kryptonit3_counter_visitor')->where('visitor', $hashvisitor)->first();
            if($visitorid){
            $pageids = DB::table('kryptonit3_counter_page_visitor')->where('visitor_id', $visitorid->id)->pluck('page_id');
            $postids = DB::table('kryptonit3_counter_page')->whereIn('id', $pageids)->where('identifier_name', 'post')->orderBy('id', 'DESC')->take(12)->pluck('identifier_id');
            $posts = Post::with('post_authors')->where('post_status', 'publish')->where('hide', 0)->whereIn('id', $postids)->get();

            return view('pages.artikel', compact('pagetitle', 'posts'));
            }else{
                return view('blank.artikel');
            }
        } else {
            return view('blank.artikel');
        }
        return view('blank.artikel');
    }

    public function showfcategoryposts($permalink, Request $request) {
        $category = Featured_category::where('category_slug', '=', $permalink)->first();
        $pagetitle = 'Topik: ' . $category->category_title;
        $post_metum = Post_metum::where('meta_name', '=', 'post_featured_category')->where('meta_value', '=', $category->id)->orderBy('created_at', 'DESC')->pluck('post_id');
        $posts = Post::with('post_authors')->where('post_status', 'publish')->where('hide', 0)->whereIn('id', $post_metum)->orderBy('published_at', 'DESC')->paginate(12);

        //infinite scroll
        if ($request->ajax()) {
           return view('widgets.article_row', compact('posts'));;
        }

        return view('pages.artikel_infinite', compact('pagetitle', 'posts'));
    }

    public function gototopik() {
        ///kayaknya ini ga kepake deh, delete aja
        //$topik = $request->input('topik');
        //echo $topik;
        //return Redirect::route('/topik/'.$topik);
    }

    public function incrementviewcounter(Request $request) {
        $id = $request->id;
        DB::table('posts')->whereId($id)->increment('view_count');
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function incrementsharecounter(Request $request) {
        $id = $request->id;
        DB::table('posts')->whereId($id)->increment('share_count');
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function like(Request $request) {
        $postid = $request->postid;
        $followerid = $request->followerid;
        $post = Post::find($postid);
        $follower = User::find($followerid);
        $post->like($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function unlike(Request $request) {
        $postid = $request->postid;
        $followerid = $request->followerid;
        $post = Post::find($postid);
        $follower = User::find($followerid);
        $post->unlike($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function incrementlikecounter(Request $request) {
        $id = $request->postid;
        DB::table('posts')->whereId($id)->increment('like_count');
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function decrementlikecounter(Request $request) {
        $id = $request->postid;
        DB::table('posts')->whereId($id)->decrement('like_count');
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function bookmark(Request $request) {
        $postid = $request->postid;
        $followerid = $request->followerid;
        $post = Post::find($postid);
        $follower = User::find($followerid);
        $post->bookmark($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

    public function unbookmark(Request $request) {
        $postid = $request->postid;
        $followerid = $request->followerid;
        $post = Post::find($postid);
        $follower = User::find($followerid);
        $post->unbookmark($follower);
        return response()->json(['responseText' => 'Success!'], 200);
    }

}
