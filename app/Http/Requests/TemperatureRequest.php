<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemperatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day' => 'required|date_format:Y-m-d',
        ];
    }
}
