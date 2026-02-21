<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\Serializers\Mission\MissionSerializer;

final class ShowMissionController extends Controller
{
    public function __construct(
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(Request $request, Mission $mission): JsonResponse
    {
        $this->authorize('view', $mission);

        return response()->json([
            'data' => $this->serializer->serializeModel($mission->load(['technician', 'photos', 'garage'])),
        ]);
    }
}
