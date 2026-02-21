<?php

declare(strict_types=1);

namespace Infrastructure\Serializers\Mission;

use App\Models\Mission as MissionModel;
use Domain\Mission\Entities\Mission;

final readonly class MissionSerializer
{
    public function serialize(Mission $mission): array
    {
        return [
            'id' => (string) $mission->id,
            'garage_id' => (string) $mission->garageId,
            'technician_id' => $mission->technicianId ? (string) $mission->technicianId : null,
            'vehicle' => [
                'brand' => $mission->vehicleBrand,
                'model' => $mission->vehicleModel,
                'year' => $mission->vehicleYear,
            ],
            'glazing_type' => $mission->glazingType->value,
            'glazing_type_label' => $mission->glazingType->label(),
            'intervention_type' => $mission->interventionType->value,
            'intervention_type_label' => $mission->interventionType->label(),
            'location' => [
                'address' => $mission->location->address,
                'city' => $mission->location->city,
                'postal_code' => $mission->location->postalCode,
                'latitude' => $mission->location->latitude,
                'longitude' => $mission->location->longitude,
                'full_address' => $mission->location->fullAddress(),
            ],
            'preferred_date' => $mission->preferredDate->format('c'),
            'price_offer' => $mission->priceOffer,
            'status' => $mission->status->value,
            'status_label' => $mission->status->label(),
            'status_color' => $mission->status->color(),
            'created_at' => $mission->createdAt->format('c'),
        ];
    }

    public function serializeModel(MissionModel $mission): array
    {
        return [
            'id' => $mission->id,
            'garage_id' => $mission->garage_id,
            'technician_id' => $mission->technician_id,
            'vehicle' => [
                'brand' => $mission->vehicle_brand,
                'model' => $mission->vehicle_model,
                'year' => $mission->vehicle_year,
                'plate' => $mission->vehicle_plate,
            ],
            'glazing_type' => $mission->glazing_type->value,
            'glazing_type_label' => $mission->glazing_type->label(),
            'intervention_type' => $mission->intervention_type->value,
            'intervention_type_label' => $mission->intervention_type->label(),
            'description' => $mission->description,
            'location' => [
                'address' => $mission->address,
                'city' => $mission->city,
                'postal_code' => $mission->postal_code,
                'latitude' => $mission->latitude,
                'longitude' => $mission->longitude,
            ],
            'preferred_date' => $mission->preferred_date->format('Y-m-d'),
            'preferred_time_slot' => $mission->preferred_time_slot,
            'price_offer' => $mission->price_offer,
            'status' => $mission->status->value,
            'status_label' => $mission->status->label(),
            'status_color' => $mission->status->color(),
            'published_at' => $mission->published_at?->format('c'),
            'accepted_at' => $mission->accepted_at?->format('c'),
            'completed_at' => $mission->completed_at?->format('c'),
            'created_at' => $mission->created_at->format('c'),
            'photos' => $mission->relationLoaded('photos') 
                ? $mission->photos->map(fn($p) => ['id' => $p->id, 'type' => $p->type, 'url' => $p->url])->toArray()
                : [],
        ];
    }

    public function serializeCollection(array $missions): array
    {
        return array_map(
            fn (Mission $mission) => $this->serialize($mission),
            $missions
        );
    }

    public function serializeModelCollection(array $missions): array
    {
        return array_map(
            fn (MissionModel $mission) => $this->serializeModel($mission),
            $missions
        );
    }
}
