<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|email|max:255",
            "password" => "required"
        ];
    }

    public function messages()
    {
        return [
            "email.required" => "Le courriel est requis.",
            "email.email" => "Le courriel doit être une adresse email valide./ bon format.",
            "email.max" => "Le courriel ne doit pas dépasser :max caractères.",
            "password.required" => "Le mot de passe est requis."
        ];
    }
}
