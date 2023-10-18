<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookings\BookingsUpdateRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
        public function __construct(
            protected BookingService $service
            ){}
        
        public function index()
        {
            $booking = $this->service->getAll();
    
            return view('bookings.index', compact('bookings'));
        }
    
        public function create()
        {
            return view('bookings.create');
        }
    
        public function find(string $id)
        {
            if(!$booking = $this->service->find($id)){
                return back();
            }
    
            return view('bookings.show', compact('booking'));
        }
    
        public function store(BookingsUpdateRequest $request, Booking $booking)
        {
    
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
