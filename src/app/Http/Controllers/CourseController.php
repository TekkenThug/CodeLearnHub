<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * Курсы, выводимые на главной странице
     */
    public function getLandingCourses()
    {
        return response()->json([
            'data' => [
                'courses' => Course::where('is_active', true)
                            ->orderBy('students_count', 'desc')
                            ->orderBy('rate', 'desc')
                            ->limit(3)
                            ->get(),
            ],
        ]);
    }

    /**
     * Получение курсов
     */
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('sort')) {
            $sortField = $request->get('sort');
            $sortDirection = $request->get('desc', 'desc');
            $query->orderBy($sortField, $sortDirection);
        }

        if ($request->has('search')) {
            $searchPattern = '%' . $request->get('search') . '%';
            $query->where(function ($query) use ($searchPattern) {
                $query->where('name', 'like', $searchPattern)
                    ->orWhere('description', 'like', $searchPattern);
            });
        }

        if ($request->has('is_active')) {
            $query->where('is_active', true);
        }

        $courses = $query->get();

        return response()->json([
            'data' => [
                'courses' => $courses
            ]
        ]);
    }

    /**
     * Получение курсов пользователя, которые он проходит (прошел)
     */
    public function myCourses(Request $request)
    {
        return response()->json([
            'data' => [
                'courses' => User::find($request->user()->id)
                ->courses()
                ->get()
            ]
        ]);
    }

    /**
     * Получение курсов, созданных пользователем
     */
    public function authoredCourses(Request $request)
    {
        return response()->json([
            'data' => [
                'courses' => Course::where('author_id', $request->user()->id)
                ->where('is_active', true)
                ->get()
            ]
        ]);
    }

    /**
     * Получить доступные курсы
     */
    public function getAvailableCourse($id)
    {
        $course = Course::find($id);

        if (!$course->is_active) return response()->json([]);

        $modules = Module::where('course_id', '=' , $id)->orderBy('order')->get();

        foreach ($modules as $module) {
            $module->lessons;
        }

        return response()->json([
            'data' => [
                'course' => $course,
                'modules' => $modules
            ]
        ]);
    }

    /**
     * Запись на курс
     */
    public function recordToCourse(Request $request)
    {
        $courseId = $request->input('id');
        $course = Course::find($courseId);

        if (!$course->is_active) {
            return response()->status(Response::HTTP_FORBIDDEN);
        };

        $existedRecord = $request->user()->courses()->where('course_id', $courseId);

        if ($existedRecord->exists()) {
            $row = $existedRecord
                    ->select('current_module_id', 'current_lesson_id')
                    ->first();
            return response()->json([
                'data' => [
                    'module_order' => Module::find($row['current_module_id'])->order,
                    'lesson_order' => Lesson::find($row['current_lesson_id'])->order
                ]
            ]);
        }

        $module = $course->modules()->orderBy('order')->first();
        $lesson = $module->lessons()->orderBy('order')->first();
        $request->user()->courses()->attach($courseId, [
            'current_module_id' => $module->id,
            'current_lesson_id' => $lesson->id
        ]);

        $course->increment('students_count');

        return response()->json([
            'message' => 'Успешно',
            'data' => [
                'module_order' => $module->order,
                'lesson_order' => $lesson->order
            ]
        ]);
    }

    /**
     * Создание курса
     */
    public function store(Request $request)
    {
        $course = Course::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'cover' =>  'empty',
            'program_language_id' => $request['program_language'],
            'author_id' => $request->user()->id,
        ]);

        $modules = $request['modules'];
        $lessonsCount = 0;
        if (!empty($modules)) {
            // Перебираем элементы массива
            foreach ($modules as $module) {
                $createdModule = Module::create([
                    'title' => $module['title'],
                    'order' => $module['order'],
                    'course_id' => $course->id,
                ]);

                $lessons = $module['lessons'];

                if (!empty($lessons)) {
                    foreach ($lessons as $lesson) {
                        $createdLesson = Lesson::create([
                            'name' => $lesson['name'],
                            'content' => $lesson['content'],
                            'layout_code' => $lesson['layout_code'],
                            'test_code' => $lesson['test_code'],
                            'order' => $lesson['order'],
                            'module_id' => $createdModule->id,
                        ]);

                        ++$lessonsCount;
                    }
                }
            }
        }

        $course->lessons_count = $lessonsCount;
        $course->save();

        return response()->json([
            'message' => 'Курс создан успешно. После проверки он отобразится в Вашем профиле.',
            'data' => $course,
        ]);
    }

    /**
     * Получение данных конкретного пользователя
     */
    public function show($id)
    {
        return response()->json([
            'data' => Course::find($id)
        ]);
    }

    /**
     * Получить рейтинг, проставленный пользователем
     */
    public function getUserRating(Request $request)
    {
        $courseId = $request->input('id');

        $record = DB::table('course_user')
                    ->where('user_id', $request->user()->id)
                    ->where('course_id', $courseId)
                    ->first();

        if (!$record) {
            return response()->json([
                'message' => 'Курс не найден'
            ], 404);
        }

        return response()->json([
            'data' => $record->rate,
        ]);
    }

    /**
     * Выставить пользовательский рейтинг
     */
    public function setUserRating(Request $request)
    {
        $courseId = $request->input('id');

        $record = $request->user()->courses()->where('course_id', $courseId);

        if (!$record->exists()) {
            return response()->json([
                'message' => 'Курс не найден'
            ], 404);
        }

        $request->user()->courses()->syncWithoutDetaching([
            $courseId => [
                'rate' => $request->input('rate')
            ]
        ]);

        return response()->json([
            'message' => 'Рейтинг успешно выставлен'
        ]);
    }
}
