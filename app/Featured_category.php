<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured_category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'featured_categories';

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
    protected $fillable = ['category_title', 'category_slug'];

    
}
