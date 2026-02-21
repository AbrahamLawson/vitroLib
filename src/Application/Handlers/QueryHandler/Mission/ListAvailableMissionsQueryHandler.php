<?php

declare(strict_types=1);

namespace Src\Application\Handlers\QueryHandler\Mission;

use App\Models\Mission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Src\Application\Queries\Mission\ListAvailableMissionsQuery;

final class ListAvailableMissionsQueryHandler
{
    public function handle(ListAvailableMissionsQuery $query): LengthAwarePaginator
    {
        $builder = Mission::query()
            ->where('status', 'published')
            ->whereNull('technician_id')
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
