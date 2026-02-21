<?php

declare(strict_types=1);

namespace Domain\User\ValueObjects;

enum UserRole: string
{
    case GARAGE = 'garage';
    case TECHNICIAN = 'technician';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::GARAGE => 'Garage',
            self::TECHNICIAN => 'Technicien',
            self::ADMIN => 'Administrateur',
        };
    }
}
