<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|max:255|unique:clients",
            "nom" => "required|string|max:30|min:2",
            "prenom" => "required|string|max:30|min:2",
            "password" => "required|min:8|confirmed",
            "adresse" => "required|string|max:100|min:5",
            "ville" => "required|string|max:30|min:3",
            "codePostal" => "required|string|regex:/^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/", // H1H 1X1 format
            "province" => "required|string|max:2|min:2",
            "telephone" => "string|regex:/^\d{3}-\d{3}-\d{4}$/", // 514-555-1234 format
        ];
    }
}
