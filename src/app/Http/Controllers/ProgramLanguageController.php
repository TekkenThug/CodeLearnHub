<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class ProgramLanguageController extends Controller
{
    /**
     * Получение языков программирования, не занятых в курсах
     */
    public function getAcceptedCourses()
    {
        return response()->json([
            'data' => [
                'program_languages' => DB::table('program_languages')
                ->leftJoin('courses', 'program_languages.id', '=', 'courses.program_language_id')
                ->whereNull('courses.program_language_id')
                ->select('program_languages.*')
                ->get()
            ]
        ]);
    }
}
