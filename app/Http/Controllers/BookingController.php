<?php

namespace App\Http\Controllers;

use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
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

    public function calendar(Booking $booking) {
        $bookings = $booking->get();
        return response()->json($bookings);
    }

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
        $partyDate->format('Y-m-d H:i:s');

        $partyEnd = new DateTime($request->party_end);
        $partyEnd->format('Y-m-d H:i:s');

        $todayDate = date('Y-m-d H:i:s');
        
        $maxDate = new DateTime(date('Y-m-d H:i:s', strtotime($todayDate . " +".self::$min_days." days")));
        
        if ($partyDate <= $maxDate) {
            throw new ValueError("Party should be scheduled with a minimum of ".self::$min_days." days");
        }
        
        // validar se a data ja existe
        $booking_exists = $booking->where('party_start', $partyDate)->first();
        if($booking_exists) {
            // TODO: validar se o status esta confirmado antes
            throw new ValueError("Party already exists in this time");
        }

        
        $package = $this->package->find($request->package_id);
        
        if(!$package) {
            throw new ValueError("Package not found");
        }
        
        $price = $request->qnt_invited * $package->price;
        
        // $user_id = auth()->user()->id;
        // $request->user_id = $user_id;
        // $request->price = $price;
        // $request->status = BookingStatus::fromValue('P');
        
        $data = [
            "name_birthdayperson"=>$request->name_birthdayperson,
            "years_birthdayperson"=>$request->years_birthdayperson,
            "qnt_invited"=>$request->qnt_invited,
            "party_start"=>$partyDate,
            "party_end"=>$partyEnd,
            "status"=>BookingStatus::P->name,
            "user_id"=>auth()->user()->id,
            "package_id"=>$package->id,
            "price"=>$price,
        ];

        
        $booking->create((array)$data);

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

    public function update(BookingsUpdateRequest $request)
    {
        // if (!$booking = $this->service->find($request->id)) {
        //     return back();
        // }

        $booking= $this->service->update(
            UpdateBookingDTO::makeFromRequest($request)
        );
        if(!$booking){
            return back();
        }


        return redirect()->route('bookings.index');
    }
}