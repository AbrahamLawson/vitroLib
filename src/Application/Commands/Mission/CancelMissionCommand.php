<?php

declare(strict_types=1);

namespace Application\Commands\Mission;

final readonly class CancelMissionCommand
{
    public function __construct(
        public string $missionId,
        public string $garageId,
    ) {}
}
