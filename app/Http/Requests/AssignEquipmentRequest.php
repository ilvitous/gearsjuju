<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignEquipmentRequest extends FormRequest
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
            'event' => 'required',
            'equipment_id' => 'required',
            'user' => 'required',
            'equipment_request' => 'required',
            'gear_request' => 'required',
        ];
    }
}
