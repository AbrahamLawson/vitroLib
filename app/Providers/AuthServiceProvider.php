<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Mission;
use App\Policies\MissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Mission::class => MissionPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
