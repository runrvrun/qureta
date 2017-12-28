<?php

function read_time($text) {
    $words = str_word_count(strip_tags($text));
    $min = floor($words / 200);
    if ($min < 1) {
        return '1';
    }
    return $min;
}

function get_user_profesi($user_id) {
    return App\User_metum::where('user_id', '=', $user_id)->where('meta_name', '=', 'profesi')->pluck('meta_value')->first();
}

function get_user_short_bio($user_id) {
    return App\User_metum::where('user_id', '=', $user_id)->where('meta_name', '=', 'short_bio')->pluck('meta_value')->first();
}

function get_user_post_count($user_id) {
    return App\Post::where('post_author', '=', $user_id)->where('post_status', '=', 'publish')->count();
}

function get_post_buqu_count($postid) {
    return App\Buqu_post::where('post_id', '=', $postid)->count();
}

function get_buqu_post_count($buquid) {
    return App\Buqu_post::where('buqu_id', '=', $buquid)->count();
}

function get_competition_post_count($competitionid) {
    return App\Competition_post::where('competition_id', '=', $competitionid)->where('post_id','>',0)->whereNotNull('post_id')->whereHas('composts', function($query) {
                    $query->where('post_status', 'publish');
                })->count();
}

function get_workshop_post_count($id) {
    return App\Workshop_post::where('workshop_id', '=', $id)->where('workshop_id','>',0)->whereNotNull('workshop_id')->count();
}

function get_peserta_workshop($workshopid) {
    return App\Workshop_post::where('workshop_id', '=', $workshopid)->where('user_id',Auth::user()->id)->first();
}

function get_popular_post($limit = 4) {
    $stickypopuler = App\Post::with('post_authors')->whereHas('post_metum', function($query) {
                    $query->where('meta_name', 'post_featured_category')->where('meta_value', '11');
                })->where('sticky',1)->where('post_status', 'publish')->where('hide', 0)->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'DESC')->get();
    $populer = App\Post::with('post_authors')
            ->where('post_status', 'publish')->where('hide', 0)
            ->where('published_at','<=',Carbon::now())
            ->where('published_at','>=',Carbon::now()->subDays(3))
            ->orderBy('view_count', 'DESC')->take($limit)->get();
//->where('published_at','<=',Carbon::now())
    return $stickypopuler->union($populer);
}

function get_categories() {
    return App\Category::pluck('category_title', 'category_slug');
}

function get_post_category() {
    $categoryid = Post_metum::where('meta_name', 'post_category')->where('post_id', $post->id)->first();
    $category = Category::find($categoryid->meta_value);

    return $category;
}

function get_category_posts($categoryid, $limit = 4) {
    $postid = Post_metum::where('meta_name', 'post_category')->where('meta_value', $categoryid)->where('post_id', '!=', $post->id)->orderBy('post_id', 'DESC')->take(10)->pluck('post_id');
    $posts = Post::with('post_authors')->whereIn('id', $relatedid)->where('post_status', 'publish')->where('published_at','<=',Carbon::now())->take($limit)->get();
    return $posts;
}

function get_fcategories() {
    return App\Featured_category::pluck('category_title', 'category_slug');
}

function get_dd_users() {
    return App\User::select(
            DB::raw("CONCAT(name,' (',username,') (',email,')') AS name"),'id')->orderBy('name')->pluck('name', 'id');
}

function get_dd_categories() {
    return App\Category::pluck('category_title', 'id');
}

function get_dd_fcategories() {
    $opt = App\Featured_category::pluck('category_title', 'id');
    $opt->prepend('- ', 0);
    return $opt;
}

function isFollowing($userid) {
    $follow = App\Followers::where('user_id', $userid)->where('follower_id', Auth::user()->id)->get();
    if (count($follow) > 0) {
        return true;
    } else {
        return false;
    }
}

function isFollowingBuqu($buquid) {
    $follow = App\Buqufollowers::where('buqu_id', $buquid)->where('follower_id', Auth::user()->id)->get();
    if (count($follow) > 0) {
        return true;
    } else {
        return false;
    }
}

function isLiking($postid) {
    $follow = App\Likes::where('post_id', $postid)->where('follower_id', Auth::user()->id)->get();
    if (count($follow) > 0) {
        return true;
    } else {
        return false;
    }
}

function isLikingBuqu($buquid) {
    $follow = App\Buqulikes::where('buqu_id', $buquid)->where('follower_id', Auth::user()->id)->get();
    if (count($follow) > 0) {
        return true;
    } else {
        return false;
    }
}

function isLikingCompost($competitionpostid) {
    $follow = App\Competition_postlikes::where('competition_post_id', $competitionpostid)->where('follower_id', Auth::user()->id)->get();
    if (count($follow) > 0) {
        return true;
    } else {
        return false;
    }
}

function getOherLikeCompost($competitionpostid) {
    $follow = App\Competition_postlikes::with('users')->where('competition_post_id', $competitionpostid)->where('follower_id','<>', Auth::user()->id)->get();
    return $follow;
}

function getUserLikeCompost($competitionpostid) {
    $follow = App\Competition_postlikes::with('users')->where('competition_post_id', $competitionpostid)->where('follower_id','==', Auth::user()->id)->get();
    return $follow;
}

function isBookmarking($postid) {
    $follow = App\Bookmarks::where('post_id', $postid)->where('follower_id', Auth::user()->id)->get();
    if (count($follow) > 0) {
        return true;
    } else {
        return false;
    }
}

function get_banner($banner_name) {
    return App\Banner::where('name', '=', $banner_name)->first();
}

function get_unread_notifications($user_id) {
    $user = App\User::find($user_id);

    $notifs = $user->unreadNotifications;

    return $notifs;
}

function is_banned($user_id){
    return App\User::where('id',$user_id)->where('banned_until','>',Carbon::now()->toDateTimeString())->count();
}

function get_dd_competition($includeid=null) {
    //return App\Competition::pluck('competition_title', 'id');

    if($includeid){
        $opt = App\Competition::where('id',$includeid)->orwhere('competition_startdate','<=',Carbon::today()->toDateString())->Where('competition_enddate','>=',Carbon::today()->toDateString())->pluck('competition_title', 'id');
    }else{
        $opt = App\Competition::where('competition_startdate','<=',Carbon::today()->toDateString())->where('competition_enddate','>=',Carbon::today()->toDateString())->pluck('competition_title', 'id');
    }
    $opt->prepend('- ', 0);
    return $opt;
}

function update_user_post_count($user_id) {
    $post_count = App\Post::where('post_author', '=', $user_id)->where('post_status', '=', 'publish')->count();
    $user = App\User::find($user_id);
    $user->post_count = $post_count;
    $user->update();
}

function get_recommended_user() {
    return App\User_metum::with('user')->where('meta_name', '=', 'recommended')->where('meta_value', '=', '1')->inRandomOrder()->take(4)->get();
}
