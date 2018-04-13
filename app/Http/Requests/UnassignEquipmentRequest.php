<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnassignEquipmentRequest extends FormRequest
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
            'equipment_id' => 'required',
            'equipment_request' => 'required',
            
        ];
    }
}