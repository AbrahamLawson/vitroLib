<?php

declare(strict_types=1);

namespace Src\Application\Queries\Mission;

final readonly class ListAvailableMissionsQuery
{
    public function __construct(
        public string $technicianId,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?int $radiusKm = null,
        public ?string $glazingType = null,
        public ?string $interventionType = null,
        public int $page = 1,
        public int $perPage = 15,
    ) {}
}
