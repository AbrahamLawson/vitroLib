<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Application\Commands\Mission\AcceptMissionCommand;
use Application\Handlers\CommandHandler\Mission\AcceptMissionCommandHandler;
use Infrastructure\Serializers\Mission\MissionSerializer;

final class AcceptMissionController extends Controller
{
    public function __construct(
        private readonly AcceptMissionCommandHandler $handler,
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(Request $request, Mission $mission): JsonResponse
    {
        $user = $request->user();

        if (!$user->isTechnician()) {
            abort(403, 'Réservé aux techniciens.');
        }

        $command = new AcceptMissionCommand(
            missionId: $mission->id,
            technicianId: $user->id,
        );

        $mission = $this->handler->handle($command);

        return response()->json([
            'message' => 'Mission acceptée.',
            'data' => $this->serializer->serializeModel($mission),
        ]);
    }
}
