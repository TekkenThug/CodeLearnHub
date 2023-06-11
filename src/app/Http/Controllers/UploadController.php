<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Загрузка аватара
     */
    public function processAvatar(Request $request)
    {
        $image = $request->file('image');
        $user = User::find($request->input('id'));

        if (empty($user)) {
            return response()->json([
                'message' => 'Пользователя не существует',
            ], Response::HTTP_NOT_FOUND); 
        }

        if ($image) {
            $filename = 'avatars/' . uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('yandex')->put($filename, file_get_contents($image));
            $url = Storage::disk('yandex')->url($filename);

            $user->avatar = $url;
            $user->save();

            return response()->json([
                'message' => 'Аватар успешно загружен',
                'data' => [
                    'image' => $url
                ]
            ]); 
        }

        return response()->json([
            'message' => 'Файл пуст',
        ], Response::HTTP_NOT_FOUND); 
    }

    /**
     * Загрузка обложки курса
     */
    public function processCourseCover(Request $request)
    {
        $image = $request->file('image');
        $course = Course::find($request->input('id'));

        if (!$image) {
            return response()->json([
                'message' => 'Файл пуст',
            ], 401); 
        }

        if (empty($course)) {
            return response()->json([
                'message' => 'Курса не существует',
            ], 404); 
        }
         
        $filename = 'covers/' . uniqid() . '.' . $image->getClientOriginalExtension();
        Storage::disk('yandex')->put($filename, file_get_contents($image));
        $url = Storage::disk('yandex')->url($filename);

        $course->cover = $url;
        $course->save();

        return response()->json([
            'message' => 'Обложка успешно загружена',
            'data' => [
                'image' => $url
            ]
        ]); 
    }
}
