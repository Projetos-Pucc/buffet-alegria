<?php

namespace App\Providers;

use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\GuestRepository;
use App\Repositories\Contract\OpenScheduleRepository;
use App\Repositories\Contract\PackageRepository;
use App\Repositories\Contract\RecommendationRepository;
use App\Repositories\Contract\SatisfactionSurveyRepository;
use App\Repositories\Eloquent\EloquentORMBookingRepository;
use App\Repositories\Eloquent\EloquentORMGuestRepository;
use App\Repositories\Eloquent\EloquentORMOpenScheduleRepository;
use App\Repositories\Eloquent\EloquentORMPackageRepository;
use App\Repositories\Eloquent\EloquentORMRecommendationRepository;
use App\Repositories\Eloquent\EloquentORMSatisfactionSurveyRepository;
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
        $this->app->bind(GuestRepository::class, EloquentORMGuestRepository::class);
        $this->app->bind(OpenScheduleRepository::class, EloquentORMOpenScheduleRepository::class);
        $this->app->bind(SatisfactionSurveyRepository::class, EloquentORMSatisfactionSurveyRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
