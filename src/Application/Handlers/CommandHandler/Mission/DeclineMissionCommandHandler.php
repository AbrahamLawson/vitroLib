<?php

declare(strict_types=1);

namespace Src\Application\Handlers\CommandHandler\Mission;

use App\Models\Mission;
use Illuminate\Support\Facades\DB;
use Src\Application\Commands\Mission\DeclineMissionCommand;

final class DeclineMissionCommandHandler
{
    public function handle(DeclineMissionCommand $command): void
    {
        $mission = Mission::findOrFail($command->missionId);

        if ($mission->status !== 'published') {
            throw new \DomainException('Cette mission ne peut pas être refusée.');
        }

        DB::table('mission_declines')->insert([
            'mission_id' => $command->missionId,
            'technician_id' => $command->technicianId,
            'declined_at' => now(),
        ]);
    }
}
