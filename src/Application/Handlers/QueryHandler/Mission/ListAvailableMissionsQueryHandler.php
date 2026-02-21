<?php

declare(strict_types=1);

namespace Application\Handlers\QueryHandler\Mission;

use App\Models\Mission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Application\Queries\Mission\ListAvailableMissionsQuery;

final class ListAvailableMissionsQueryHandler
{
    public function handle(ListAvailableMissionsQuery $query): LengthAwarePaginator
    {
        $builder = Mission::query()
            ->where('status', 'published')
            ->whereNull('technician_id')
            ->whereNotIn('id', function ($subQuery) use ($query) {
                $subQuery->select('mission_id')
                    ->from('mission_declines')
                    ->where('technician_id', $query->technicianId);
            })
            ->with(['garage', 'photos']);

        if ($query->latitude !== null && $query->longitude !== null && $query->radiusKm !== null) {
            $builder->whereRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) <= ?',
                [$query->latitude, $query->longitude, $query->latitude, $query->radiusKm]
            );

            $builder->selectRaw(
                '*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$query->latitude, $query->longitude, $query->latitude]
            )->orderBy('distance');
        } else {
            $builder->orderBy('published_at', 'desc');
        }

        if ($query->glazingType !== null) {
            $builder->where('glazing_type', $query->glazingType);
        }

        if ($query->interventionType !== null) {
            $builder->where('intervention_type', $query->interventionType);
        }

        return $builder->paginate($query->perPage, ['*'], 'page', $query->page);
    }
}
