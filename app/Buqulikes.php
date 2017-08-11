<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buqulikes extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buqulikes';

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
    protected $fillable = ['buqu_id', 'follower_id'];

    
}
