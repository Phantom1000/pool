<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceEntryRequest extends FormRequest
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
            'maintenance_id' => 'required|integer|min:1',
            'date' => 'required|date_format:"Y-m-d"',
            'time' => 'required|date_format:"H:i"',
            'employee_id' => 'required|integer|min:-1'
        ];
    }

    public function attributes()
    {
        return [
            'maintenance' => 'Работа',
            'date' => 'Дата',
            'time' => 'Время',
            'employee' => 'Сотрудник'
        ];
    }
}
