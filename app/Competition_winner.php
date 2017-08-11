<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition_winner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competition_winners';

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
    protected $fillable = ['competition_id', 'rank', 'ranktitle', 'post_id'];

    public function competitions()
	{
		return $this->hasMany('App\Competition');
	}
	public function posts()
	{
		return $this->hasMany('App\Post');
	}
	
}
