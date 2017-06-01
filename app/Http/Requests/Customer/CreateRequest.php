<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //TODO: only admin must have opportunity to update Customer
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name'=>'required|string|max:50',
            'phone'=>'required|string|max:15',

        ];
    }

    public function messages()
    {
        return [

            'name.required'=>'Не указанно имя пользователя',
            'name.string'=>'Поле "Имя" должно иметь текстовый тип данных',
            'name.max'=>'Имя не должно превышать длинну в 50 символов',

            'phone.required'=>'Не указан телефон пользователя',
            'phone.string'=>'Поле "Телефон должно иметь текстовый формат данных"',
            'phone.max'=>'Номер телефона не должен превыщать длинну в 15 символов',

        ];
    }
}
