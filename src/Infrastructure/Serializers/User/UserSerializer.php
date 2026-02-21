<?php

declare(strict_types=1);

namespace Infrastructure\Serializers\User;

use Domain\User\Entities\User;

final readonly class UserSerializer
{
    public function serialize(User $user): array
    {
        return [
            'id' => (string) $user->id,
            'email' => (string) $user->email,
            'name' => $user->name,
            'role' => $user->role->value,
            'role_label' => $user->role->label(),
            'email_verified_at' => $user->emailVerifiedAt?->format('c'),
        ];
    }

    public function serializeCollection(array $users): array
    {
        return array_map(
            fn (User $user) => $this->serialize($user),
            $users
        );
    }
}
