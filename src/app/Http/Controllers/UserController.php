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
     * Получить всех пользователей
     */
    public function index(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return response('', Response::HTTP_FORBIDDEN);
        }

        return response()->json([
            'data' => [
                'users' => User::all()
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
