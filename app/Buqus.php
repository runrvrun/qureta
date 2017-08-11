<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Buqus extends Model {

    use Sluggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buqus';

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
    protected $fillable = ['buqu_author', 'buqu_title', 'buqu_image', 'buqu_slug', 'share_count', 'like_count', 'featured_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable() {
        return [
            'buqu_slug' => [
                'source' => 'buqu_title'
            ]
        ];
    }

    public function buqu_authors() {
        return $this->belongsTo('App\User', 'buqu_author');
    }

    function buqulikes() {
        return $this->belongsToMany('App\User', 'buqulikes', 'buqu_id', 'follower_id')->withTimestamps();
    }

    function like(User $user) {
        $this->buqulikes()->attach($user->id);
    }

    function unlike(User $user) {
        $this->buqulikes()->detach($user->id);
    }

}
