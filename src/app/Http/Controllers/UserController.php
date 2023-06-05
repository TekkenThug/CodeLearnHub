<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Получение собственных данных
     */
    public function me(Request $request)
    {
        $user = $request->user();
        $user->roles;

        return $user;
    }

    /**
     * Обновление данных о пользователе
     */
    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();

        $this->authorize('update', $user);

        $user->update($request->all());

        if (!empty($request['password'])) {
            $user->password = Hash::make($request['password']);
            $user->save();
        }

        return response()->json([
            'message' => 'Данные успешно обновленны',
            'data' => [
                'user' => $user,
            ]
        ]);
    }

    /**
     * Удаление аккаунта
     */
    public function destroy(User $user)
    {
        $this->authorize('update', $user);

        $user->delete();

        return response()->json([
            'message' => 'Аккаунт успешно удален',
        ]);
    }
}
