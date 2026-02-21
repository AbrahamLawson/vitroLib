<?php

declare(strict_types=1);

namespace Application\Handlers\CommandHandler\Mission;

use App\Models\Mission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Application\Commands\Mission\DeclineMissionCommand;
use Domain\Mission\ValueObjects\MissionStatus;

final class DeclineMissionCommandHandler
{
    public function handle(DeclineMissionCommand $command): void
    {
        $mission = Mission::findOrFail($command->missionId);

        if ($mission->status !== MissionStatus::PUBLISHED) {
            throw new \DomainException('Cette mission ne peut pas être refusée.');
        }

        DB::table('mission_declines')->insertOrIgnore([
            'id' => Str::uuid()->toString(),
            'mission_id' => $command->missionId,
            'technician_id' => $command->technicianId,
            'declined_at' => now(),
        ]);
    }
}
