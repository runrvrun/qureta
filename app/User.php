<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Database\Eloquent\Model;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable {

    use Notifiable;
    use Messagable;
    use HasPushSubscriptions;

    protected $connection = 'qureta_prod';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'phone_number','user_image' ,'user_image_cover', 'role', 'password', 'status', 'banned_until','last_login'
    ];

    protected $dates = ['last_login'];

    protected $searchableColumns = ['username'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function posts(){
        return $this->hasMany('App\Post', 'post_author');
    }

    function followers() {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'follower_id')->withTimestamps();
    }

    function follow(User $user) {
        $this->followers()->attach($user->id);
    }

    function unfollow(User $user) {
        $this->followers()->detach($user->id);
    }

}
