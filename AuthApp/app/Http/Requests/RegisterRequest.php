<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed', new StrongPassword],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'email' => filter_var($this->email, FILTER_SANITIZE_EMAIL),
            'name' => trim($this->name),
        ]);
    }
}
