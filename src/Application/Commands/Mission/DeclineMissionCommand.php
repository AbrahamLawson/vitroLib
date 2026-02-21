<?php

declare(strict_types=1);

namespace Src\Application\Commands\Mission;

final readonly class DeclineMissionCommand
{
    public function __construct(
        public string $missionId,
        public string $technicianId,
    ) {}
}
