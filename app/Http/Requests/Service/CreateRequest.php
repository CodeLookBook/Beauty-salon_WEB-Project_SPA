<?php

namespace App\Http\Requests\Service;

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
        return true; //TODO: Доступ к созданию и редактированию спаска услуг должен иметь только администратор.
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
            'name.required'=>'Должно быть указанно название услуги.',
            'name.string'=>'Поле "Название" должно иметь текстовый тип данных.',
            'name.max' =>'Длинна поля "Название" не должна превыщать 255 символов.',
        ];
    }
}
