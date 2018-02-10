<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $connection = 'qureta_kuliah';

    protected $table = 'courses';

    protected $primaryKey = 'id';

    protected $fillable = ['topic_id', 'teacher_id1', 'teacher_id2', 'teacher_id3', 'name', 'description', 'announcement', 'slug', 'url_foto', 'enrolls_start', 'enrolls_end'];

    public function teachers() {
        return $this->belongsTo('App\Teachers', 'teacher_id1');
    }

    public function course_users() {
        return $this->hasMany('App\CourseUser');
    }
    public function lectures() {
        return $this->hasMany('App\Lectures');
    }

}
