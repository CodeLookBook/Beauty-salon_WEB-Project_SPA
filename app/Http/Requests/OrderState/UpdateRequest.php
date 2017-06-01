<?php

namespace App\Http\Requests\OrderState;

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Укажите текущее состояние записи',
            'name.string'=>'Значение должно иметь текстовый тип данных',
            'name.max'=>'Длинна строки не должна превышать 255 символов',
        ];
    }
}
