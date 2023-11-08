<?php

namespace App\Providers;

use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\PackageRepository;
use App\Repositories\Contract\RecommendationRepository;
use App\Repositories\Eloquent\EloquentORMBookingRepository;
use App\Repositories\Eloquent\EloquentORMPackageRepository;
use App\Repositories\Eloquent\EloquentORMRecommendationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RecommendationRepository::class,EloquentORMRecommendationRepository::class);
        $this->app->bind(PackageRepository::class, EloquentORMPackageRepository::class);
        $this->app->bind(BookingRepository::class, EloquentORMBookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
