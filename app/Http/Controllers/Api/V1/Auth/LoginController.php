<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Infrastructure\Serializers\User\UserSerializer;

final class LoginController extends Controller
{
    public function __construct(
        private readonly UserSerializer $serializer,
    ) {}

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->validated('email'))->first();

        if (!$user || !Hash::check($request->validated('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'user' => $this->serializer->serialize($this->toDomainUser($user)),
            'token' => $token,
        ]);
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
