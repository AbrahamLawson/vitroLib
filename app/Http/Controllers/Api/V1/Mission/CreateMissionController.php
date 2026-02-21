<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\CreateMissionRequest;
use Application\Commands\Mission\CreateMissionCommand;
use Application\Handlers\CommandHandler\Mission\CreateMissionCommandHandler;
use Illuminate\Http\JsonResponse;
use Infrastructure\Serializers\Mission\MissionSerializer;

final class CreateMissionController extends Controller
{
    public function __construct(
        private readonly CreateMissionCommandHandler $handler,
        private readonly MissionSerializer $serializer,
    ) {}

    public function __invoke(CreateMissionRequest $request): JsonResponse
    {
        $command = new CreateMissionCommand(
            garageId: $request->user()->id,
            vehicleBrand: $request->validated('vehicle_brand'),
            vehicleModel: $request->validated('vehicle_model'),
            vehicleYear: $request->validated('vehicle_year'),
            vehiclePlate: $request->validated('vehicle_plate'),
            glazingType: $request->validated('glazing_type'),
            interventionType: $request->validated('intervention_type'),
            description: $request->validated('description'),
            address: $request->validated('address'),
            city: $request->validated('city'),
            postalCode: $request->validated('postal_code'),
            latitude: $request->validated('latitude'),
            longitude: $request->validated('longitude'),
            preferredDate: $request->validated('preferred_date'),
            preferredTimeSlot: $request->validated('preferred_time_slot'),
            priceOffer: $request->validated('price_offer'),
        );

        $mission = $this->handler->handle($command);

        return response()->json([
            'message' => 'Mission créée avec succès.',
            'data' => $this->serializer->serializeModel($mission),
        ], 201);
    }
}
