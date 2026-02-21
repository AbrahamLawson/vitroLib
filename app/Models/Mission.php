<?php

declare(strict_types=1);

namespace App\Models;

use Domain\Mission\ValueObjects\GlazingType;
use Domain\Mission\ValueObjects\InterventionType;
use Domain\Mission\ValueObjects\MissionStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Mission extends Model
{
    use HasFactory;
    use HasUuids;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'garage_id',
        'technician_id',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_year',
        'vehicle_plate',
        'glazing_type',
        'intervention_type',
        'description',
        'address',
        'city',
        'postal_code',
        'latitude',
        'longitude',
        'preferred_date',
        'preferred_time_slot',
        'price_offer',
        'status',
        'published_at',
        'accepted_at',
        'completed_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'glazing_type' => GlazingType::class,
            'intervention_type' => InterventionType::class,
            'status' => MissionStatus::class,
            'preferred_date' => 'date',
            'published_at' => 'datetime',
            'accepted_at' => 'datetime',
            'completed_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'latitude' => 'float',
            'longitude' => 'float',
            'price_offer' => 'integer',
            'vehicle_year' => 'integer',
        ];
    }

    public function garage(): BelongsTo
    {
        return $this->belongsTo(User::class, 'garage_id');
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(MissionPhoto::class);
    }

    public function isPublished(): bool
    {
        return $this->status === MissionStatus::PUBLISHED;
    }

    public function isDraft(): bool
    {
        return $this->status === MissionStatus::DRAFT;
    }

    public function canBeAccepted(): bool
    {
        return $this->status === MissionStatus::PUBLISHED;
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, [MissionStatus::DRAFT, MissionStatus::PUBLISHED], true);
    }

    public function publish(): void
    {
        $this->update([
            'status' => MissionStatus::PUBLISHED,
            'published_at' => now(),
        ]);
    }

    public function cancel(): void
    {
        $this->update([
            'status' => MissionStatus::CANCELLED,
            'cancelled_at' => now(),
        ]);
    }
}
