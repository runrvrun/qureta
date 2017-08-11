<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competitions';

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
    protected $fillable = ['competition_author', 'competition_startdate', 'competition_enddate', 'competition_title', 'competition_content'];
    
    protected $dates = ['competition_startdate','competition_enddate'];
    
    public function comp_authors() {
        return $this->belongsTo('App\User', 'competition_author');
    }
    
}
