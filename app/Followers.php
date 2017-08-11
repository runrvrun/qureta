<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'followers';

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
    protected $fillable = ['user_id', 'follower_id'];
    
    public function followers() {
        return $this->belongsTo('App\User', 'follower_id');
    }
    
    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
}
