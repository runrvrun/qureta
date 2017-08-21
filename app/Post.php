<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model {

    use Sluggable;
    use SearchableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';
    protected $dates = [
        'published_at'
    ];
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'posts.post_title' => 10,
            'posts.post_content' => 5,
        ],
    ];
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['post_author', 'post_title', 'post_subtitle', 'post_content', 'post_status', 'comment_status', 'post_slug', 'post_image', 'post_image_credit', 'view_count', 'comment_count', 'share_count', 'like_count', 'buqu_count','hide','updated_by','updated_at','published_by','published_at','sticky','hide_adsense','require_login'];

    public function post_authors() {
        return $this->belongsTo('App\User', 'post_author');
    }

    public function post_metum() {
        return $this->hasMany('App\Post_metum');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() {
        return [
            'post_slug' => [
                'source' => 'post_title'
            ]
        ];
    }

    function likes() {
        return $this->belongsToMany('App\User', 'likes', 'post_id', 'follower_id')->withTimestamps();
    }

    function like(User $user) {
        $this->likes()->attach($user->id);
    }

    function unlike(User $user) {
        $this->likes()->detach($user->id);
    }

    function bookmarks() {
        return $this->belongsToMany('App\User', 'bookmarks', 'post_id', 'follower_id')->withTimestamps();
    }

    function bookmark(User $user) {
        $this->bookmarks()->attach($user->id);
    }

    function unbookmark(User $user) {
        $this->bookmarks()->detach($user->id);
    }

}
