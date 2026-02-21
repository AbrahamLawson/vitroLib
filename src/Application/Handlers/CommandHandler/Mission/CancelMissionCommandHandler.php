<?php

declare(strict_types=1);

namespace Application\Handlers\CommandHandler\Mission;

use App\Models\Mission;
use Application\Commands\Mission\CancelMissionCommand;
use Domain\Mission\ValueObjects\MissionStatus;

final class CancelMissionCommandHandler
{
    public function handle(CancelMissionCommand $command): Mission
    {
        $mission = Mission::where('id', $command->missionId)
            ->where('garage_id', $command->garageId)
            ->firstOrFail();

        if (!in_array($mission->status, [MissionStatus::DRAFT, MissionStatus::PUBLISHED], true)) {
            throw new \DomainException('Cette mission ne peut pas être annulée.');
        }

        $mission->update([
            'status' => MissionStatus::CANCELLED,
            'cancelled_at' => now(),
        ]);

        return $mission->fresh();
    }
}
