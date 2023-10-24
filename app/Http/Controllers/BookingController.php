<?php

namespace App\Http\Controllers;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
use App\Http\Requests\Bookings\BookingsUpdateRequest;
use App\Models\Booking;
use App\Services\BookingService;
use App\Services\PackageService;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use TypeError;
use ValueError;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $service,
        protected PackageService $package
    ) {
    }

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

    public function store(BookingsUpdateRequest $request)
    {
        $retornos = new MessageBag();
    
        try {
            $this->service->create(CreateBookingDTO::makeFromRequest($request));
            $retornos->add('msg', 'Aniversario criado com sucesso!');
            return redirect()->route('bookings.index');
        } catch (TypeError $e) {
            // Captura uma exceção de tipo (TypeError)
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        } catch (Exception $e) {
            // Captura outras exceções
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        }
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