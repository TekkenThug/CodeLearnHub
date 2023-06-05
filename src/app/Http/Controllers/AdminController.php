<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\News;
use App\Models\ProgramLanguage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Обновление данных пользователя
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('admin') || $user->is_owner) {
            return response()->json([
                'message' => 'У вас нет доступа для обновления информации пользователя'
            ],  Response::HTTP_FORBIDDEN);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'Информация о пользователе успешно обновлена'
        ]);
    }

    /**
     * Блокировка пользователя
     */
    public function banUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('admin') || $user->is_owner) {
            return response()->json([
                'message' => 'У вас нет доступа для обновления информации пользователя'
            ],  Response::HTTP_FORBIDDEN);
        }

        if ($suser->isBanned()) {
            return response()->json([
                'message' => 'Пользователь уже забанен'
            ], 400);
        }

        $user->ban($request->input('reason'));
        
        return response()->json(['message' => 'Пользователь забанен успешно']);
    }

    /**
     * Добавления языка программирования
     */
    public function addLanguage(Request $request)
    {
        $language = $request->input('language');

        if (ProgramLanguage::where('name', $language)->exists()) {
            return response()->json(['message' => 'Язык уже существует'], 400);
        }

        ProgramLanguage::create([
            'name' => $language
        ]);

        return response()->json(['message' => 'Язык создан успешно']);
    }

    /**
     * Создание новости
     */
    public function postNews(Request $request)
    {
        $news = new News($request->all());
        $news->save();

        return response()->json(['message' => 'Новость успешно создана']);
    }

    /**
     * Обновление новости
     */
    public function updateNews(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->update($request->all());

        return response()->json([
            'message' => 'Новость успешно обновлена'
        ]);
    }

    /**
     * Удаление новости
     */
    public function deleteNews(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->delete();

        return response()->json([
            'message' => 'Новость успешно удалена'
        ]);
    }
}
