<?php

declare(strict_types=1);

namespace App\Http\Requests\Mission;

use Domain\Mission\ValueObjects\GlazingType;
use Domain\Mission\ValueObjects\InterventionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CreateMissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isGarage() === true;
    }

    public function rules(): array
    {
        return [
            'vehicle_brand' => ['required', 'string', 'max:100'],
            'vehicle_model' => ['required', 'string', 'max:100'],
            'vehicle_year' => ['required', 'integer', 'min:1990', 'max:' . (date('Y') + 1)],
            'vehicle_plate' => ['nullable', 'string', 'max:20'],
            
            'glazing_type' => ['required', Rule::enum(GlazingType::class)],
            'intervention_type' => ['required', Rule::enum(InterventionType::class)],
            'description' => ['nullable', 'string', 'max:2000'],
            
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'regex:/^[0-9]{5}$/'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            
            'preferred_date' => ['required', 'date', 'after:today'],
            'preferred_time_slot' => ['nullable', 'string', 'in:morning,afternoon,evening'],
            
            'price_offer' => ['required', 'integer', 'min:50', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'vehicle_brand.required' => 'La marque du véhicule est obligatoire.',
            'vehicle_model.required' => 'Le modèle du véhicule est obligatoire.',
            'vehicle_year.required' => 'L\'année du véhicule est obligatoire.',
            'vehicle_year.min' => 'L\'année doit être supérieure à 1990.',
            
            'glazing_type.required' => 'Le type de vitrage est obligatoire.',
            'intervention_type.required' => 'Le type d\'intervention est obligatoire.',
            
            'address.required' => 'L\'adresse est obligatoire.',
            'city.required' => 'La ville est obligatoire.',
            'postal_code.required' => 'Le code postal est obligatoire.',
            'postal_code.regex' => 'Le code postal doit contenir 5 chiffres.',
            
            'preferred_date.required' => 'La date souhaitée est obligatoire.',
            'preferred_date.after' => 'La date doit être dans le futur.',
            
            'price_offer.required' => 'Le prix proposé est obligatoire.',
            'price_offer.min' => 'Le prix minimum est de 50€.',
            'price_offer.max' => 'Le prix maximum est de 5000€.',
        ];
    }
}
