<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Mission;
use App\Models\User;
use Domain\Mission\ValueObjects\MissionStatus;

final class MissionPolicy
{
    public function view(User $user, Mission $mission): bool
    {
        return $user->isAdmin()
            || $mission->garage_id === $user->id
            || $mission->technician_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isGarage();
    }

    public function update(User $user, Mission $mission): bool
    {
        return $mission->garage_id === $user->id
            && $mission->status === MissionStatus::DRAFT;
    }

    public function publish(User $user, Mission $mission): bool
    {
        return $mission->garage_id === $user->id
            && $mission->status === MissionStatus::DRAFT;
    }

    public function cancel(User $user, Mission $mission): bool
    {
        return $mission->garage_id === $user->id
            && in_array($mission->status, [MissionStatus::DRAFT, MissionStatus::PUBLISHED], true);
    }

    public function uploadPhoto(User $user, Mission $mission): bool
    {
        return $mission->garage_id === $user->id;
    }

    public function deletePhoto(User $user, Mission $mission): bool
    {
        return $mission->garage_id === $user->id
            && $mission->status === MissionStatus::DRAFT;
    }
}
