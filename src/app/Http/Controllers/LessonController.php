<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Comments;

class LessonController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('forTeach'))
        {
            $course = Course::find($request->input('courseId'));

            if (!$course->is_active) return response()->json([]);

            $module = Module::where('course_id', $course->id)
            ->where('order', $request->input('moduleOrder'))
            ->first();

            $lesson = Lesson::where('module_id', $module->id)
            ->where('order', $request->input('lessonOrder'))
            ->first();

            $comments = $lesson->comments;
            $module = $lesson->module;
            $module->course;

            foreach ($comments as $comment) {
                $comment->user;
            }

            return response()->json([
                'data' => $lesson,
            ]);
        }
    }
}
