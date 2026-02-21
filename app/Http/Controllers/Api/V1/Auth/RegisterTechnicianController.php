<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterTechnicianRequest;
use App\Models\User;
use Domain\User\ValueObjects\UserRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Serializers\User\UserSerializer;

final class RegisterTechnicianController extends Controller
{
    public function __construct(
        private readonly UserSerializer $serializer,
    ) {}

    public function __invoke(RegisterTechnicianRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
            'role' => UserRole::TECHNICIAN,
            'phone' => $request->validated('phone'),
            'service_radius_km' => $request->validated('service_radius_km'),
            'latitude' => $request->validated('latitude'),
            'longitude' => $request->validated('longitude'),
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'user' => $this->serializer->serialize($this->toDomainUser($user)),
            'token' => $token,
        ], 201);
    }

    private function toDomainUser(User $model): \Domain\User\Entities\User
    {
        return new \Domain\User\Entities\User(
            id: \Domain\Shared\ValueObjects\UserId::fromString($model->id),
            email: new \Domain\User\ValueObjects\Email($model->email),
            name: $model->name,
            role: $model->role,
            emailVerifiedAt: $model->email_verified_at?->toImmutable(),
        );
    }
}
