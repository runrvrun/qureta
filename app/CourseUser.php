<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    protected $connection = 'qureta_kuliah';

    protected $table = 'course_users';

    protected $primaryKey = 'id';

    public function course() {
        return $this->belongsTo('App\Course', 'course_id');
    }

}
