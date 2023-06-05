<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Регистрация пользователя
     */
    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $newUser = User::create([
            'nickname' => $validated['nickname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'], ['rounds' => 12])
        ]);

        return response()->json([
            'message' => 'Пользователь успешно создан',
            'data' => [
                'user' => $newUser
            ]
        ]);
    }

    /**
     * Вход пользователя
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return response()->json([
                'error' => 'Неверный логин или пароль'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        if (User::find($user->id)->is_blocked) {
            return response()->json([
                'error' => 'Вы заблокированы по причине: ' . User::find($user->id)->block_reason
            ], Response::HTTP_UNAUTHORIZED);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Вход произведен успешно',
            'data' => [
                'user' => Auth::user()
            ]
        ]);
    }

    /**
     * Выход пользователя
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Вы вышли из системы'
        ]);
    }
}
