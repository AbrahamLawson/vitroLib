<?php

declare(strict_types=1);

namespace Src\Application\Handlers\CommandHandler\Mission;

use App\Models\Mission;
use Src\Application\Commands\Mission\AcceptMissionCommand;

final class AcceptMissionCommandHandler
{
    public function handle(AcceptMissionCommand $command): Mission
    {
        $mission = Mission::findOrFail($command->missionId);

        if ($mission->status !== 'published') {
            throw new \DomainException('Cette mission ne peut pas être acceptée.');
        }

        if ($mission->technician_id !== null) {
            throw new \DomainException('Cette mission a déjà été acceptée par un autre technicien.');
        }

        $mission->update([
            'technician_id' => $command->technicianId,
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return $mission->fresh(['garage', 'technician', 'photos']);
    }
}
