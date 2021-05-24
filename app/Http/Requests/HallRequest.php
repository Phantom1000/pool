<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'floor' => 'required|integer|min:1',
            'lanes' => 'required|integer|min:1',
            'places' => 'required|integer|min:1'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Название',
            'floor' => 'Этаж',
            'lanes' => 'Количество дорожек',
            'places' => 'Число мест на дорожку'
        ];
    }
}
