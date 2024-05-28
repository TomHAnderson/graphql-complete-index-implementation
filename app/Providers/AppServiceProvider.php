<?php

declare(strict_types=1);

namespace App\Providers;

use ApiSkeletons\Laravel\Doctrine\ApiKey\Service\ApiKeyService;
use Illuminate\Support\ServiceProvider;

use function app;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app(ApiKeyService::class)->init(app('em'));
    }
}
