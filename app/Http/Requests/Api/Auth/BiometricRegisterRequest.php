<?php

namespace App\Http\Requests\Api\Auth;


use Illuminate\Foundation\Http\FormRequest;


class BiometricRegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'device_id' => 'required|string'
        ];
    }

}
