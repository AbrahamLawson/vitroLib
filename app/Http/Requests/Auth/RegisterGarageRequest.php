<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class RegisterGarageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'company_name' => ['required', 'string', 'max:255'],
            'kbis_number' => ['required', 'string', 'max:14', 'regex:/^[0-9]{9,14}$/'],
            'terms_accepted' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'phone.required' => 'Le téléphone est obligatoire.',
            'company_name.required' => 'Le nom de l\'entreprise est obligatoire.',
            'kbis_number.required' => 'Le numéro Kbis est obligatoire.',
            'kbis_number.regex' => 'Le numéro Kbis doit contenir entre 9 et 14 chiffres.',
            'terms_accepted.accepted' => 'Vous devez accepter les CGU/CGV.',
        ];
    }
}
