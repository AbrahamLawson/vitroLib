<?php

declare(strict_types=1);

namespace Application\Commands\Mission;

final readonly class PublishMissionCommand
{
    public function __construct(
        public string $missionId,
        public string $garageId,
    ) {}
}
