<?php

declare(strict_types=1);

namespace Domain\User\Entities;

use Domain\Shared\ValueObjects\UserId;
use Domain\User\ValueObjects\Email;
use Domain\User\ValueObjects\UserRole;

final readonly class User
{
    public function __construct(
        public UserId $id,
        public Email $email,
        public string $name,
        public UserRole $role,
        public ?\DateTimeImmutable $emailVerifiedAt = null,
    ) {}

    public function isGarage(): bool
    {
        return $this->role === UserRole::GARAGE;
    }

    public function isTechnician(): bool
    {
        return $this->role === UserRole::TECHNICIAN;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }
}
