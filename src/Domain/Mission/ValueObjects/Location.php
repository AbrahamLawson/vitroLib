<?php

declare(strict_types=1);

namespace Domain\Mission\ValueObjects;

final readonly class Location
{
    public function __construct(
        public string $address,
        public string $city,
        public string $postalCode,
        public float $latitude,
        public float $longitude,
    ) {}

    public function fullAddress(): string
    {
        return "{$this->address}, {$this->postalCode} {$this->city}";
    }

    public function distanceTo(Location $other): float
    {
        $earthRadius = 6371;

        $latFrom = deg2rad($this->latitude);
        $lonFrom = deg2rad($this->longitude);
        $latTo = deg2rad($other->latitude);
        $lonTo = deg2rad($other->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) ** 2 +
            cos($latFrom) * cos($latTo) * sin($lonDelta / 2) ** 2;

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
