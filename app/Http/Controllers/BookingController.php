<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookings\BookingsUpdateRequest;
use App\Models\Booking;
use App\Services\BookingService;
use App\Services\PackageService;
use DateTime;
use Illuminate\Http\Request;
use ValueError;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $service,
        protected PackageService $package
    ) {
    }

    public static int $min_days = 5; //numero minimo de dias para poder criar uma festa

    public function index()
    {
        $bookings = $this->service->getAll();

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $packages = $this->package->getAllByStatus(true);

        return view('bookings.create', compact('packages'));
    }

    public function find(string $id)
    {
        if (!$booking = $this->service->find($id)) {
            return back()->with('');
        }

        return view('bookings.show', compact('booking'));
    }

    public function store(BookingsUpdateRequest $request, Booking $booking)
    {
        // validar se a data é menor que hoje + min_days (5 dias)
        $partyDate = new DateTime($request->party_start);
        $partyDate->format('Y-m-d h-i-s');
        $todayDate = date('Y-m-d h-i-s');
        
        $maxDate = new DateTime(date('Y-m-d h-i-s', strtotime($todayDate . " +".self::$min_days." days")));
        
        if ($partyDate <= $maxDate) {
            throw new ValueError("Party should be scheduled with a minimum of ".self::$min_days." days");
        }
        
        // validar se a data ja existe
        $booking_exists = $booking->where('party_start', $partyDate)->first();
        if($booking_exists) {
            // TODO: validar se o status esta confirmado antes
            throw new ValueError("Party already exists in this time");
        }

        $user_id = auth()->user()->id;

        echo $user_id;
        // $booking->create();

        return redirect()->route('bookings.index');
    }
    public function delete(Request $request)
    {
        $this->service->delete($request->id);

        return redirect()->route('bookings.index');
    }
    public function edit(Request $request)
    {
        if (!$booking = $this->service->find($request->id)) {
            return back();
        }

        return view('bookings.update', compact('booking'));
    }

    public function update(Request $request)
    {
        if (!$booking = $this->service->find($request->id)) {
            return back();
        }

        // $package= $this->service->update($request->only([
        //     'name_package', 'food_description', 'beverages_description', 'photo_1', 'photo_2', 'photo_3', 'slug'
        // ]));
        return redirect()->route('bookings.index');
    }
}
