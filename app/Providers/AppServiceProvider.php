<?php

namespace App\Providers;

use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\GuestRepository;
use App\Repositories\Contract\PackageRepository;
use App\Repositories\Eloquent\EloquentORMBookingRepository;
use App\Repositories\Eloquent\EloquentORMGuestRepository;
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
        $this->app->bind(GuestRepository::class, EloquentORMGuestRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
