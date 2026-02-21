<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Application\Commands\Mission\PublishMissionCommand;
use Application\Handlers\CommandHandler\Mission\PublishMissionCommandHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\Serializers\Mission\MissionSerializer;

final class PublishMissionController extends Controller
{
    public function __construct(
        private readonly PublishMissionCommandHandler $handler,
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(Request $request, Mission $mission): JsonResponse
    {
        $this->authorize('publish', $mission);

        $command = new PublishMissionCommand(
            missionId: $mission->id,
            garageId: $request->user()->id,
        );

        $mission = $this->handler->handle($command);

        return response()->json([
            'message' => 'Mission publiée avec succès.',
            'data' => $this->serializer->serializeModel($mission),
        ]);
    }
}
