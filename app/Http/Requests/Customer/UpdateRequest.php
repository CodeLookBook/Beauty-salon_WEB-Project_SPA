<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //TODO: only admin can edit customer, only customer can make his data
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'string|max:50',
            'phone'=>'string|max:15'
        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'Поле "Имя" должно иметь текстовый тип данных',
            'name.max'=>'Имя не должно превышать длинну в 50 символов',

            'phone.string'=>'Поле "Телефон должно иметь текстовый формат данных"',
            'phone.max'=>'Номер телефона не должен превышать длинну в 15 символов',
        ];
    }
}
