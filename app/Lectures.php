<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lectures extends Model
{
    protected $connection = 'qureta_kuliah';
    protected $table = 'lectures';

    protected $primaryKey = 'id';

    protected $fillable = ['course_id', 'chapter_id', 'name', 'description', 'slug', 'url_video', 'duration', 'order'];

    public function chapters() {
    	return $this->belongsTo('App\Chapters', 'chapter_id');
    }

    public function course() {
    	return $this->belongsTo('App\Course', 'course_id');
    }

}
