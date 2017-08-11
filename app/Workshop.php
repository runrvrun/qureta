<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workshop';

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
    protected $fillable = ['workshop_author', 'workshop_startdate', 'workshop_enddate', 'workshop_title', 'workshop_content','workshop_link'];
    
    protected $dates = ['workshop_startdate','workshop_enddate'];
    
    public function workshop_authors() {
        return $this->belongsTo('App\User', 'workshop_author');
    }
    
}
