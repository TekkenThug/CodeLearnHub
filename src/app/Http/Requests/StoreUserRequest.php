<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nickname' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => ['required', Password::defaults()],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nickname.required' => 'Поле обязательно к заполнению',
            'email.required' => 'Поле обязательно к заполнению',
            'email.email' => 'Поле должно быть формата e-mail',
            'email.unique' => 'Пользователь с таким email существует',
            'password.required' => 'Поле обязательно к заполнению',
        ];
    }
}
