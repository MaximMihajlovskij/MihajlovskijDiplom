<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCameraRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name_camera' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_namber' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:100',
            'price' => 'required|numeric|min:0',
            'firm_id' => 'required|integer|exists:firms,id',
            'quantity' => 'required|numeric|min:0',
        ];
    }
}

