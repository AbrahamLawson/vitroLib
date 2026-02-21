<?php

declare(strict_types=1);

namespace Domain\Mission\Entities;

use Domain\Mission\ValueObjects\MissionId;
use Domain\Mission\ValueObjects\MissionStatus;
use Domain\Mission\ValueObjects\GlazingType;
use Domain\Mission\ValueObjects\InterventionType;
use Domain\Mission\ValueObjects\Location;
use Domain\Shared\ValueObjects\UserId;

final readonly class Mission
{
    public function __construct(
        public MissionId $id,
        public UserId $garageId,
        public ?UserId $technicianId,
        public string $vehicleBrand,
        public string $vehicleModel,
        public int $vehicleYear,
        public GlazingType $glazingType,
        public InterventionType $interventionType,
        public Location $location,
        public \DateTimeImmutable $preferredDate,
        public int $priceOffer,
        public MissionStatus $status,
        public \DateTimeImmutable $createdAt,
    ) {}

    public function isPublished(): bool
    {
        return $this->status === MissionStatus::PUBLISHED;
    }

    public function isAccepted(): bool
    {
        return $this->status === MissionStatus::ACCEPTED;
    }

    public function canBeAccepted(): bool
    {
        return $this->status === MissionStatus::PUBLISHED;
    }

    public function canBeCancelled(): bool
    {
        return $this->status === MissionStatus::PUBLISHED;
    }
}
