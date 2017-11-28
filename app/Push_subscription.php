<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push_subscription extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'push_subscriptions';

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
    protected $fillable = ['user_id', 'endpoint', 'public_key', 'auth_token'];

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
