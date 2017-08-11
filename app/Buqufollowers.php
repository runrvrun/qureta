<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buqufollowers extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buqufollowers';

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
    protected $fillable = ['buqu_id', 'follower_id'];

    function followers() {
        return $this->belongsToMany('App\Buqus', 'buqufollowers', 'buqu_id', 'follower_id');
    }

    function follow(User $buqu) {
        $this->followers()->attach($buqu->id);
    }

    function unfollow(User $buqu) {
        $this->followers()->detach($buqu->id);
    }

}
