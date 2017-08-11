<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop_files extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workshop_posts';
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
    protected $fillable = ['workshop_id', 'user_id', 'name', 'original_filename', 'filename'];

}
