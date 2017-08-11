<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

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
    protected $fillable = ['user_id', 'profile_intro', 'profile_slug', 'profesi', 'minat', 'email', 'twitter', 'website', 'profile_header_image'];

    public function user_id()
	{
		return $this->hasMany('App\Users');
	}
	
}
