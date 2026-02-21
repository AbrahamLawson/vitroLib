<?php

declare(strict_types=1);

namespace App\Http\Requests\Mission;

use Domain\Mission\ValueObjects\GlazingType;
use Domain\Mission\ValueObjects\InterventionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateMissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isGarage() === true;
    }

    public function rules(): array
    {
        return [
            'vehicle_brand' => ['sometimes', 'string', 'max:100'],
            'vehicle_model' => ['sometimes', 'string', 'max:100'],
            'vehicle_year' => ['sometimes', 'integer', 'min:1990', 'max:' . (date('Y') + 1)],
            'vehicle_plate' => ['nullable', 'string', 'max:20'],
            
            'glazing_type' => ['sometimes', Rule::enum(GlazingType::class)],
            'intervention_type' => ['sometimes', Rule::enum(InterventionType::class)],
            'description' => ['nullable', 'string', 'max:2000'],
            
            'address' => ['sometimes', 'string', 'max:255'],
            'city' => ['sometimes', 'string', 'max:100'],
            'postal_code' => ['sometimes', 'string', 'regex:/^[0-9]{5}$/'],
            'latitude' => ['sometimes', 'numeric', 'between:-90,90'],
            'longitude' => ['sometimes', 'numeric', 'between:-180,180'],
            
            'preferred_date' => ['sometimes', 'date', 'after:today'],
            'preferred_time_slot' => ['nullable', 'string', 'in:morning,afternoon,evening'],
            
            'price_offer' => ['sometimes', 'integer', 'min:50', 'max:5000'],
        ];
    }
}
