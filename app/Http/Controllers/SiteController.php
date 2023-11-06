<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\BookingService;
use App\Services\PackageService;

class SiteController extends Controller
{

    public function __construct(
        protected BookingService $service
    ) {
    }

    public function dashboard()
    {
        $bookings = $this->service->getAll();

        return view('dashboard', compact('bookings'));
    }
}