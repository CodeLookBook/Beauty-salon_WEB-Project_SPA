<?php

namespace App\Http\Requests\Order;

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
        return true; //TODO: Only admin can update orders!
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order.customer.name' => 'required|string|max:50',
            'order.customer.phone' => 'required|max:15',
            'order.service.id' => 'required|integer|exists:services,id',
            //'order.date' => 'required|date_format:"d.m.Y"|after_or_equal:today',
            'order.date' => 'required|date_format:"d.m.Y"',
            'order.time' => 'required|date_format:"H:i"',
            'order.state.id'=>'required'
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
            'order.customer.name.required'    => 'Поле "Имя" является обязательным.',
            'order.customer.name.string'      => 'Поле "Имя" является должно иметь строковый тип данных.',
            'order.customer.name.max'         => 'Длинна Имени не должна превышать 50 символов.',
            'order.customer.phone.required'   => 'Поле "Телефон" является обязательным.',
            'order.customer.phone.max'        => 'Длинна строки с номером телефона не должна превышать 15 символов.',

            'order.service.id.required'       => 'Необходимо выбрать услугу.',
            'order.service.id.integer'        => 'Значение ID должно иметь целочисленный тип данных.',
            'order.service.id.exists:services,id'=>'Выбранная услуга не предоставляется. Выберите другую услугу.',

            'order.date.required'             => "Укажите желаемую дату.",
            'order.date.date_format'          => 'Неверный формат даты',
//            'order.date.after_or_equal'       => 'Нельзя выбрать прошедшую дату в календаре. Выберите правильную дату.',

            'order.time.required'             => "Укажите желаемое время.",
            'order.time.date_format'          => "Неверный формат времени.",

            'order.state.id.required'         => "Укажите статус записи",
        ];
    }
}
