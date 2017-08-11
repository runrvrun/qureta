<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition_postlikes extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competition_postlikes';

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
    protected $fillable = ['competition_post_id', 'follower_id'];
    
    public function users() {
        return $this->belongsTo('App\User', 'follower_id');
    }

    
}
