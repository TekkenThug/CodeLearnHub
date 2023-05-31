<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramLanguage;
use App\Models\Module;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover',
        'program_language_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function programLanguage()
    {
        return $this->belongsTo(ProgramLanguage::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
