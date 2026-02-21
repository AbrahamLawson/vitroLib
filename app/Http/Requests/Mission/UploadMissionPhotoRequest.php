<?php

declare(strict_types=1);

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

final class UploadMissionPhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isGarage() === true;
    }

    public function rules(): array
    {
        return [
            'photo' => ['required', 'image', 'max:5120'],
            'type' => ['required', 'string', 'in:damage,vehicle,before,after'],
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'La photo est obligatoire.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.max' => 'La photo ne doit pas dépasser 5 Mo.',
            'type.required' => 'Le type de photo est obligatoire.',
            'type.in' => 'Type invalide. Valeurs autorisées: damage, vehicle, before, after.',
        ];
    }
}
