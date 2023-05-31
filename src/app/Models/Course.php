<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramLanguage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover',
        'program_language_id',
    ];

    public function programLanguage()
    {
        return $this->belongsTo(ProgramLanguage::class);
    }
}
