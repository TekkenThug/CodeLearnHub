<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\ProgramLanguage;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Comments;
use App\Services\ProgramTest;


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

    /**
     * Проверка тестирования
     */
    public function checkTest(Request $request)
    {
        $lesson = Lesson::find($request->input('lessonId'));
        $course = Course::find(Module::find($lesson->module_id))->first();
        $courseLanguage = ProgramLanguage::find($course->program_language_id)->name;
        $code = $request->input('code');
        $lessonCode = $lesson->test_code;

        $test = new ProgramTest();
        $result = $test->run($courseLanguage, $code, $lessonCode);

        if (!$result) {
            return response()->json([
                'message' => 'Ошибка! Проверьте код',
                'data' => [
                    'result' => $result
                ]
            ]);
        }

        $lessonOrder = null;
        $moduleOrder = null;
        $existedRecord = $request->user()->courses();
        $nextLesson = Lesson::where('order', $lesson->order + 1)->where('module_id', $lesson->module_id);

        if ($nextLesson->exists()) {
            $module = Module::find($lesson->module_id);
            $lessonOrder = $nextLesson->first()->order;
            $moduleOrder = $module->order;

            $existedRecord->syncWithoutDetaching([
                $course->id => [
                    'current_module_id' => $module->id,
                    'current_lesson_id' => $nextLesson->first()->id
                ]
            ]);

            return response()->json([
                'message' => 'Отлично! Урок пройден!',
                'data' => [
                    'result' => $result,
                    'module_order' => $moduleOrder,
                    'lesson_order' => $lessonOrder,
                    'bebra' => $nextLesson->first()->id
                ]
            ]);
        }

        $nextModule = Module::where('order', $lesson->module->order + 1)->where('id', $lesson->module_id);

        if ($nextModule->exists()) {
            $moduleOrder = $nextModule->first()->order;
            $lesson = Lesson::where('module_id', $nextModule->first()->id)
            ->where('order', 1)
            ->first();

            $existedRecord->syncWithoutDetaching([
                $course->id => [
                    'current_module_id' => $nextModule->first()->id,
                    'current_lesson_id' => $lesson->id
                ]
            ]);

            return response()->json([
                'message' => 'Отлично! Урок пройден!',
                'data' => [
                    'result' => $result,
                    'module_order' => $moduleOrder,
                    'lesson_order' => $lesson->order,
                ]
            ]);
        }

        $existedRecord->syncWithoutDetaching([
            $course->id => [
                'is_complete' => true,
            ]
        ]);

        return response()->json([
            'message' => 'Отлично! Урок пройден!',
            'data' => [
                'result' => $result,
                'is_done' => true
            ]
        ]);
    }
}
