<?php

declare(strict_types=1);

namespace Domain\Mission\ValueObjects;

enum InterventionType: string
{
    case REPLACE = 'replace';
    case REPAIR = 'repair';
    case CALIBRATION = 'calibration';

    public function label(): string
    {
        return match ($this) {
            self::REPLACE => 'Remplacement',
            self::REPAIR => 'Réparation',
            self::CALIBRATION => 'Calibration ADAS',
        };
    }
}
