<?php

declare(strict_types=1);

namespace Domain\Shared\ValueObjects;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class UserId
{
    private function __construct(
        public UuidInterface $value,
    ) {}

    public static function generate(): self
    {
        return new self(Uuid::uuid7());
    }

    public static function fromString(string $value): self
    {
        return new self(Uuid::fromString($value));
    }

    public function __toString(): string
    {
        return $this->value->toString();
    }

    public function equals(UserId $other): bool
    {
        return $this->value->equals($other->value);
    }
}
