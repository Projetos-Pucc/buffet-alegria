<?php

namespace App\Http\Controllers;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
use App\Http\Requests\Bookings\BookingsUpdateRequest;
use App\Models\Booking;
use App\Services\BookingService;
use App\Services\GuestService;
use App\Services\OpenScheduleService;
use App\Services\PackageService;
use App\Services\RecommendationService;
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
        protected PackageService $package,
        protected RecommendationService $recommendations,
        protected GuestService $guests,
    ) {
        // $this->middleware('role:administrative|commercial', ['except'=>['create', 'index', 'calendar', 'find', 'store', 'edit', 'update', 'delete', 'teste']]);
    }

    public function calendar(Booking $booking) {
        $bookings = $booking->with(['open_schedule'])->get();
        return response()->json($bookings);
    }

    public function list(Request $request){
        $format = $request->get('format', 'all');
        if($format == 'pendent') {
            $bookings = $this->service->paginate_pendent_bookings(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5));
        } else {
            $format = 'all';
            $bookings = $this->service->paginate(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), filter: $request->filter);
        }

        $min_days = $this->service::$min_days; 
        return view('bookings.list', compact('bookings', 'min_days', 'format'));
    }
    
    public function index(Request $request)
    {
        // Lista somente as próximas reservas
        $bookings = $this->service->paginate_next_bookings(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5));
        $min_days = $this->service::$min_days; 

        return view('bookings.index', compact('bookings', 'min_days'));
    }

    public function create()
    {
        $packages = $this->package->getAllByStatus(true);

        return view('bookings.create', compact('packages'));
    }

    public function find(string $id, Request $request)
    {
        if (!$booking = $this->service->find($id)) {
            return redirect()->route('bookings.not_found');
        }

        $recommendations = $this->recommendations->getAll();
        $recommendations = array_slice($recommendations, 0, 10);

        $guests = $this->guests->getByBookingPaginate(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), id: $id);

        return view('bookings.show', compact('booking', 'recommendations', 'guests'));
    }

    public function store(BookingsUpdateRequest $request)
    {
        $retornos = new MessageBag();
    
        try {
            $booking = $this->service->create(CreateBookingDTO::makeFromRequest($request));
            $retornos->add('msg', 'Aniversario criado com sucesso!');
            return redirect()->route('bookings.show', $booking->id);
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

        return back();
    }
    public function negar(Request $request)
    {
        $this->service->negar($request->id);

        return back();
    }
    public function edit(Request $request)
    {
        if (!$booking = $this->service->find($request->id)) {
            return redirect()->route('bookings.not_found');
        }
        $packages = $this->package->getAllByStatus(true);


        return view('bookings.update', compact('booking','packages'));
    }

    public function update(BookingsUpdateRequest $request)
    {        
        $retornos = new MessageBag();
    
        try {
            $this->service->update(UpdateBookingDTO::makeFromRequest($request));
            $retornos->add('msg', 'Aniversario atualizado com sucesso!');
            return redirect()->route('bookings.show', $request->id);
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

    public function not_found(){
        return view('bookings.booking-not-found');
    }
}