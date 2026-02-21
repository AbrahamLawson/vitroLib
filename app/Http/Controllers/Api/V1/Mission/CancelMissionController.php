<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Application\Commands\Mission\CancelMissionCommand;
use Application\Handlers\CommandHandler\Mission\CancelMissionCommandHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\Serializers\Mission\MissionSerializer;

final class CancelMissionController extends Controller
{
    public function __construct(
        private readonly CancelMissionCommandHandler $handler,
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(Request $request, Mission $mission): JsonResponse
    {
        $this->authorize('cancel', $mission);

        $command = new CancelMissionCommand(
            missionId: $mission->id,
            garageId: $request->user()->id,
        );

        $mission = $this->handler->handle($command);

        return response()->json([
            'message' => 'Mission annulée.',
            'data' => $this->serializer->serializeModel($mission),
        ]);
    }
}
