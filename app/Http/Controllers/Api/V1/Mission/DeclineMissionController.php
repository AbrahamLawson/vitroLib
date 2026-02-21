<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Application\Commands\Mission\DeclineMissionCommand;
use Application\Handlers\CommandHandler\Mission\DeclineMissionCommandHandler;

final class DeclineMissionController extends Controller
{
    public function __construct(
        private readonly DeclineMissionCommandHandler $handler,
    ) {}

    public function __invoke(Request $request, Mission $mission): JsonResponse
    {
        $user = $request->user();

        if (!$user->isTechnician()) {
            abort(403, 'Réservé aux techniciens.');
        }

        $command = new DeclineMissionCommand(
            missionId: $mission->id,
            technicianId: $user->id,
        );

        $this->handler->handle($command);

        return response()->json([
            'message' => 'Mission masquée de votre liste.',
        ]);
    }
}
