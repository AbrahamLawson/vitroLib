<?php

declare(strict_types=1);

namespace Domain\Mission\ValueObjects;

enum GlazingType: string
{
    case WINDSHIELD = 'windshield';
    case REAR_WINDOW = 'rear_window';
    case SIDE_FRONT_LEFT = 'side_front_left';
    case SIDE_FRONT_RIGHT = 'side_front_right';
    case SIDE_REAR_LEFT = 'side_rear_left';
    case SIDE_REAR_RIGHT = 'side_rear_right';
    case SUNROOF = 'sunroof';

    public function label(): string
    {
        return match ($this) {
            self::WINDSHIELD => 'Pare-brise',
            self::REAR_WINDOW => 'Lunette arrière',
            self::SIDE_FRONT_LEFT => 'Vitre avant gauche',
            self::SIDE_FRONT_RIGHT => 'Vitre avant droite',
            self::SIDE_REAR_LEFT => 'Vitre arrière gauche',
            self::SIDE_REAR_RIGHT => 'Vitre arrière droite',
            self::SUNROOF => 'Toit ouvrant',
        };
    }
}
