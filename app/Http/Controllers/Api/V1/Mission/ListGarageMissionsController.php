<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Infrastructure\Serializers\Mission\MissionSerializer;

final class ListGarageMissionsController extends Controller
{
    public function __construct(
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $missions = Mission::where('garage_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->with(['technician', 'photos'])
            ->paginate($request->query('per_page', 20));

        return response()->json([
            'data' => $this->serializer->serializeModelCollection($missions->items()),
            'meta' => [
                'current_page' => $missions->currentPage(),
                'last_page' => $missions->lastPage(),
                'per_page' => $missions->perPage(),
                'total' => $missions->total(),
            ],
        ]);
    }
}
