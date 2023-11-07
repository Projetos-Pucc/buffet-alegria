<?php

namespace App\Providers;

use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\OpenScheduleRepository;
use App\Repositories\Contract\PackageRepository;
use App\Repositories\Eloquent\EloquentORMBookingRepository;
use App\Repositories\Eloquent\EloquentORMOpenScheduleRepository;
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
        $this->app->bind(BookingRepository::class, EloquentORMBookingRepository::class);
        $this->app->bind(OpenScheduleRepository::class, EloquentORMOpenScheduleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
