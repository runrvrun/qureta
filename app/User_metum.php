<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_metum extends Model
{

    protected $connection = 'qureta_prod';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_meta';

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
    protected $fillable = ['user_id', 'meta_name', 'meta_value'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
