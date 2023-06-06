<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Comments;

class LessonController extends Controller
{
    /**
     * Получение данных об уроке для изучения
     */
    public function getForTeach(Request $request)
    {
        $courseId = $request->input('courseId');
        $course = Course::find($courseId);
        $moduleOrder = $request->input('moduleOrder');
        $lessonOrder = $request->input('lessonOrder');

        if (!$course->is_active) return response()->json([]);

        $existedRecord = $course->users()->where('user_id', $request->user()->id);

        // Если не записан
        if (!$existedRecord->exists()) {
            response()->json([
                'message' => 'Вас нет на курсе'
            ], 403);
        }

        $row = $existedRecord
        ->select('current_module_id', 'current_lesson_id')
        ->first();
        $module = null;
        $lesson = null;
        $currentModule = Module::where('id', $row->current_module_id)->first();

        // Если пытаются взять следующий непройденный модуль
        if ($currentModule->order < $moduleOrder) {
            $module = $currentModule;
            $lesson = Lesson::where('id', $row->current_lesson_id)->first();

            return response()->json([
                'data' => [
                    'redirect' => [
                        'module_order' => $module->order,
                        'lesson_order' => $lesson->order,
                    ],
                ],
            ]); 
        } else {
            $module = Module::where('course_id', $course->id)
            ->where('order', $moduleOrder)
            ->first();

            $currentLesson = Lesson::where('id', $row->current_lesson_id)->first();

            // Если пытаются взять непройденный урок
            if ($currentLesson->order < $lessonOrder) {
                $lesson = $currentLesson;

                return response()->json([
                    'data' => [
                        'redirect' => [
                            'module_order' => $module->order,
                            'lesson_order' => $lesson->order,
                        ],
                    ],
                ]); 
            } else {
                $lesson = Lesson::where('module_id', $module->id)
                ->where('order', $lessonOrder)
                ->first();
            }
        }

        $comments = $lesson->comments;
        $module = $lesson->module;
        $module->course;

        foreach ($comments as $comment) {
            $comment->user;
        }

        return response()->json([
            'data' => [
                'lesson' => $lesson,
            ],
        ]);
    }
    }
}
