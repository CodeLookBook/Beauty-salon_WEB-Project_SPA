<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //TODO: Проверить нужен ли это метод в целом вообще
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email',
            'password'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Не указан логин пользователя (e-mail)',
            'email.email'       => 'Логин пользователя (e-mail) указан с ошибкой. Проверьте правильность формата указанных данных.',
            'password.required' => 'Не указан пароль пользователя'
        ];
    }
}
