<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
    protected $fillable = ['post_author', 'post_content', 'post_title', 'post_status', 'comment_status', 'post_slug'];

    public function post_authors()
	{
		//return $this->hasMany('App\Users');
                return $this->belongsTo('App\User', 'post_author');
	}
	
}
