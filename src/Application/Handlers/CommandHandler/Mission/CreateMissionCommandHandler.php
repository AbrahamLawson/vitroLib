<?php

declare(strict_types=1);

namespace Application\Handlers\CommandHandler\Mission;

use App\Models\Mission;
use Application\Commands\Mission\CreateMissionCommand;
use Domain\Mission\ValueObjects\MissionStatus;

final class CreateMissionCommandHandler
{
    public function handle(CreateMissionCommand $command): Mission
    {
        return Mission::create([
            'garage_id' => $command->garageId,
            'vehicle_brand' => $command->vehicleBrand,
            'vehicle_model' => $command->vehicleModel,
            'vehicle_year' => $command->vehicleYear,
            'vehicle_plate' => $command->vehiclePlate,
            'glazing_type' => $command->glazingType,
            'intervention_type' => $command->interventionType,
            'description' => $command->description,
            'address' => $command->address,
            'city' => $command->city,
            'postal_code' => $command->postalCode,
            'latitude' => $command->latitude,
            'longitude' => $command->longitude,
            'preferred_date' => $command->preferredDate,
            'preferred_time_slot' => $command->preferredTimeSlot,
            'price_offer' => $command->priceOffer,
            'status' => MissionStatus::DRAFT,
        ]);
    }
}
