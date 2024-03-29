<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Lesson;

class Module extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'title',
        'order',
        'course_id',
    ];

    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
