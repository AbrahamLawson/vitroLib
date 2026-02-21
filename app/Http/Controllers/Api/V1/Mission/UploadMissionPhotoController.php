<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\UploadMissionPhotoRequest;
use App\Models\Mission;
use App\Models\MissionPhoto;
use Illuminate\Http\JsonResponse;

final class UploadMissionPhotoController extends Controller
{
    public function __invoke(UploadMissionPhotoRequest $request, Mission $mission): JsonResponse
    {
        $this->authorize('uploadPhoto', $mission);

        $file = $request->file('photo');
        $path = $file->store("missions/{$mission->id}", 'public');

        $photo = MissionPhoto::create([
            'mission_id' => $mission->id,
            'type' => $request->validated('type'),
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
        ]);

        return response()->json([
            'message' => 'Photo ajoutée.',
            'data' => [
                'id' => $photo->id,
                'type' => $photo->type,
                'url' => $photo->url,
            ],
        ], 201);
    }
}
