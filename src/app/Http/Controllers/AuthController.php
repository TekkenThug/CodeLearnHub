<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register new user
     */
    public function register(StoreUserRequest $request) {
        $validated = $request->validated();

        $newUser = User::create([
            'first_name' => $validated['firstName'],
            'second_name' => $validated['secondName'],
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
}
