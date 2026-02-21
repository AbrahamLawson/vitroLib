<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Mission;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\MissionPhoto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class DeleteMissionPhotoController extends Controller
{
    public function __invoke(Request $request, Mission $mission, MissionPhoto $photo): JsonResponse
    {
        $this->authorize('deletePhoto', $mission);

        if ($photo->mission_id !== $mission->id) {
            abort(404, 'Photo non trouvée.');
        }

        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return response()->json([
            'message' => 'Photo supprimée.',
        ]);
    }
}
