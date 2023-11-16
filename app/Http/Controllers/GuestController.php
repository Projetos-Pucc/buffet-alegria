<?php

namespace App\Http\Controllers;

use App\DTO\Guests\CreateGuestDTO;
use App\DTO\Guests\UpdateGuestDTO;
use App\Enums\BookingStatus;
use App\Http\Requests\Guests\GuestsUpdateRequest;
use App\Services\BookingService;
use App\Services\GuestService;
use Error;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct(
        protected GuestService $service,
        protected BookingService $booking
    )
    {}

    public function index(Request $request)
    {
        $guests = $this->service->paginate(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), filter: $request->filter);;;

        return view('guests.index',compact('guests'));

    }

    public function invite(Request $request)
    {
        $booking = $this->booking->find($request->booking);

        if(!$booking) {
            throw new Error('festa nao encontrada');
        }

        if($booking->status !== BookingStatus::A->name){
            throw new Error('festa indisponivel para cadastrar convidados');
        }  

        return view('guests.invite', compact('booking'));

    }

    public function not_found() {
        return view('guests.guest-not-found');
    }

    public function find(string $id)
    {
        if(!$guest = $this->service->find($id)){
            return back();
        }
        return view('guests.show',compact('guest'));
    }

    public function store(GuestsUpdateRequest $request)
    {
        $guest = $this->service->create(CreateGuestDTO::makeFromRequest($request));

        return redirect()->route('guests.approved', $guest['booking_id']);
    }

    public function delete(Request $request)
    {
        $this->service->delete($request->id);

        return redirect()->route('guests.index');

    }

    public function approved(Request $request){
        $booking = $this->booking->find($request->booking);

        if(!$booking) {
            return redirect()->route('bookings.not_found');
        }

        return view('guests.guest-confirmation', compact('booking'));
    }
    
}
