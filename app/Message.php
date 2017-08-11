<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

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
    protected $fillable = ['sender_id', 'receiver_id', 'message_title', 'message_content'];

    public function senders()
	{
		return $this->hasMany('App\Users');
	}
	public function receivers()
	{
		return $this->hasMany('App\Users');
	}
	
}
