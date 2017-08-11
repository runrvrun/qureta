<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_metum extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_meta';

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
    protected $fillable = ['post_id', 'meta_name', 'meta_value'];
    
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
