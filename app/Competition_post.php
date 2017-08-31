<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition_post extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competition_posts';

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
    protected $fillable = ['competition_id', 'post_id', 'nilai'];

    public function competitions() {
        return $this->hasMany('App\Competition');
    }
    
    public function competition() {
        return $this->belongsTo('App\Competition', 'competition_id');
    }

    public function posts() {
        return $this->belongsTo('App\Post','post_id');
    }
    
    public function comps() {
        return $this->belongsTo('App\Competition', 'competition_id');
    }
    
    public function composts() {
        return $this->belongsTo('App\Post', 'post_id');
    }

    function competition_postlikes() {
        return $this->belongsToMany('App\User', 'competition_postlikes', 'competition_post_id', 'follower_id')->withTimestamps();
    }

    function like(User $user) {
        $this->competition_postlikes()->attach($user->id);
    }

    function unlike(User $user) {
        $this->competition_postlikes()->detach($user->id);
    }
}
