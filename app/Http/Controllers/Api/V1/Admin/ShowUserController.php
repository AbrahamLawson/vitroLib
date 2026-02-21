<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class ShowUserController extends Controller
{
    public function __invoke(User $user): JsonResponse
    {
        return response()->json([
            'data' => $user,
        ]);
    }
}
