<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop_post extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workshop_members';
    public $timestamps = false;

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
    protected $fillable = ['workshop_id', 'name', 'user_id', 'email', 'phone_number','address','tempat_lahir','tgl_lahir','tgl_daftar'];

}
