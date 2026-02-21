<?php

declare(strict_types=1);

namespace Application\Handlers\CommandHandler\Mission;

use App\Models\Mission;
use Application\Commands\Mission\PublishMissionCommand;
use Domain\Mission\ValueObjects\MissionStatus;

final class PublishMissionCommandHandler
{
    public function handle(PublishMissionCommand $command): Mission
    {
        $mission = Mission::where('id', $command->missionId)
            ->where('garage_id', $command->garageId)
            ->firstOrFail();

        if ($mission->status !== MissionStatus::DRAFT) {
            throw new \DomainException('Seules les missions en brouillon peuvent être publiées.');
        }

        $mission->update([
            'status' => MissionStatus::PUBLISHED,
            'published_at' => now(),
        ]);

        return $mission->fresh();
    }
}
