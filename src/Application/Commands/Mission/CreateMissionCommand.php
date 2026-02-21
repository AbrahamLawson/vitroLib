<?php

declare(strict_types=1);

namespace Application\Commands\Mission;

final readonly class CreateMissionCommand
{
    public function __construct(
        public string $garageId,
        public string $vehicleBrand,
        public string $vehicleModel,
        public int $vehicleYear,
        public ?string $vehiclePlate,
        public string $glazingType,
        public string $interventionType,
        public ?string $description,
        public string $address,
        public string $city,
        public string $postalCode,
        public float $latitude,
        public float $longitude,
        public string $preferredDate,
        public ?string $preferredTimeSlot,
        public int $priceOffer,
    ) {}
}
