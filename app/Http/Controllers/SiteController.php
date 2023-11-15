<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function __construct(
        protected BookingService $service
    ) {
    }

    public function dashboard(Request $request)
    {
        $bookings = $this->service->getUserBookingsPaginate(user_id: auth()->user()->id, page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), filter: $request->filter);
        return view('dashboard', compact('bookings'));
    }
}