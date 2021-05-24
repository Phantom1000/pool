<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'startdate' => 'required|date_format:"Y-m-d"',
            'enddate' => 'required|date_format:"Y-m-d"|after:startdate',
            'starttime' => 'required|date_format:"H:i"',
            'endtime' => 'required|date_format:"H:i"|after:starttime',
            'couples' => 'required|integer|min:1',
            'hall_id' => 'required|integer|min:1'
        ];
    }

    public function attributes()
    {
        return [
            'startdate' => 'Начальная дата',
            'enddate' => 'Конечная дата',
            'starttime' => 'Время начала работы',
            'endtime' => 'Время окончания работы',
            'couples' => 'Количество пар',
            'hall_id' => 'Зал'
        ];
    }
}
