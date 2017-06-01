<?php

namespace App\Http\Requests\Service;

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
        return true; //TODO: Only admin can make updates.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'Поле "Название" должно иметь текстовый тип данных.',
            'name.max' =>'Длинна поля "Название" не должна превыщать 255 символов.',
        ];
    }
}
