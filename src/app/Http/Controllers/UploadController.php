<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
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
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($filename, file_get_contents($image));
        
            $url = Storage::url($filename);

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
}
