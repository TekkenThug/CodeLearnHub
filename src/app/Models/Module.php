<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'title',
        'order',
        'course_id',
    ];

    use HasFactory;
}
