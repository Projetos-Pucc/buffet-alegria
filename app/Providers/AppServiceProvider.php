<?php

namespace App\Providers;

use App\Repositories\Contract\PackageRepository;
use App\Repositories\Eloquent\EloquentORMPackageRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PackageRepository::class, EloquentORMPackageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
