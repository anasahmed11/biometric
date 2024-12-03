<?php

namespace App\Http\Requests\Api\Auth;


use Illuminate\Foundation\Http\FormRequest;


class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required','string','confirmed','min:8', 'regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{8,}$/']
        ];
    }

}
