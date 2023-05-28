<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register new user
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
     * Login user
     */
    public function login(Request $request)
    {
        $credentials  = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Неверный логин или пароль'
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
     * Logout user
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
