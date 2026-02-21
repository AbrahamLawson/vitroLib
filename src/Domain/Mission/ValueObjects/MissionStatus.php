<?php

declare(strict_types=1);

namespace Domain\Mission\ValueObjects;

enum MissionStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ACCEPTED = 'accepted';
    case IN_PROGRESS = 'in_progress';
    case PENDING_VALIDATION = 'pending_validation';
    case COMPLETED = 'completed';
    case DISPUTED = 'disputed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Brouillon',
            self::PUBLISHED => 'Publiée',
            self::ACCEPTED => 'Acceptée',
            self::IN_PROGRESS => 'En cours',
            self::PENDING_VALIDATION => 'En attente de validation',
            self::COMPLETED => 'Terminée',
            self::DISPUTED => 'Litige',
            self::CANCELLED => 'Annulée',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::PUBLISHED => 'blue',
            self::ACCEPTED => 'indigo',
            self::IN_PROGRESS => 'yellow',
            self::PENDING_VALIDATION => 'orange',
            self::COMPLETED => 'green',
            self::DISPUTED => 'red',
            self::CANCELLED => 'gray',
        };
    }
}
