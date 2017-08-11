<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buqu_post extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buqu_posts';

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
    protected $fillable = ['buqu_id', 'post_id'];

    public function buqus() {
        return $this->hasMany('App\Buqu');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }    

}
