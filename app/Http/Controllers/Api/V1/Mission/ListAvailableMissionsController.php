<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Application\Handlers\QueryHandler\Mission\ListAvailableMissionsQueryHandler;
use Application\Queries\Mission\ListAvailableMissionsQuery;
use Infrastructure\Serializers\Mission\MissionSerializer;

final class ListAvailableMissionsController extends Controller
{
    public function __construct(
        private readonly ListAvailableMissionsQueryHandler $handler,
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user->isTechnician()) {
            abort(403, 'Réservé aux techniciens.');
        }

        $query = new ListAvailableMissionsQuery(
            technicianId: $user->id,
            latitude: $request->float('latitude') ?: null,
            longitude: $request->float('longitude') ?: null,
            radiusKm: $request->integer('radius') ?: null,
            glazingType: $request->string('glazing_type')->toString() ?: null,
            interventionType: $request->string('intervention_type')->toString() ?: null,
            page: $request->integer('page', 1),
            perPage: $request->integer('per_page', 15),
        );

        $missions = $this->handler->handle($query);

        return response()->json([
            'data' => $missions->map(fn ($m) => $this->serializer->serializeModel($m)),
            'meta' => [
                'current_page' => $missions->currentPage(),
                'last_page' => $missions->lastPage(),
                'per_page' => $missions->perPage(),
                'total' => $missions->total(),
            ],
        ]);
    }
}
