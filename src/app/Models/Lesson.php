<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Lesson extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'content',
        'layout_code',
        'test_code',
        'order',
        'module_id'
    ];

    use HasFactory;

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
