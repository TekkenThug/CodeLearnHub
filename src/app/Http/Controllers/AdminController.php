<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\News;
use App\Models\Ticket;
use App\Models\ProgramLanguage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    /**
     * Получение списка пользователей
     */
    public function getAllUsers(Request $request)
    {
        if ($request->user()->is_owner) {
            return response()->json([
                'data' => [
                    'users' => User::all()
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'users' => User::whereDoesntHave('roles', function ($query) {
                    $query->where('name', 'admin');
                })->get()
            ]
        ]);
    }

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
     * Получение списка языков программирования
     */
    public function getLanguages(Request $request)
    {
        return response()->json(['data' => ProgramLanguage::orderBy('id')->get()]);
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

        $language = ProgramLanguage::create([
            'name' => $language
        ]);

        return response()->json([
            'message' => 'Язык создан успешно',
            'data' => $language,
        ]);
    }

    /**
     * Создание новости
     */
    public function postNews(Request $request)
    {
        $news = new News($request->all());
        $news->admin_id = $request->user()->id;
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

    /**
     * Получение тикетов администратора
     */
    public function myTickets(Request $request)
    {
        return response()->json([
            'data' => Ticket::where('admin_id', $request->user()->id)
                            ->orderBy('resolve', 'asc')
                            ->get()
        ]);
    }

     /**
     * Получение всех активных тикетов
     */
    public function getActiveTickets(Request $request)
    {
        return response()->json([
            'data' => Ticket::where('resolve', false)
                            ->where('admin_id', NULL)
                            ->get()
        ]);
    }

    /**
     * Взятие тикета
     */
    public function takeTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->resolve) {
            return response()->json(['message' => 'Обращение уже разрешено'], 400);
        }

        if ($ticket->admin_id) {
            return response()->json(['message' => 'Обращение уже разрешается'], 400);
        }

        $ticket->admin_id = $request->user()->id;
        $ticket->save();

        return response()->json(['message' => 'Обращение получено']);
    }

    /**
     * Завершения тикета
     */
    public function checkResolve(Request $request, $id) 
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->resolve) {
            return response()->json(['message' => 'Обращение уже разрешено'], 400);
        }

        $ticket->resolve = true;
        $ticket->save();

        return response()->json(['message' => 'Обращение успешно разрешено']);
    }
}
