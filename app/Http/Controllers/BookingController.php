<?php

namespace App\Http\Controllers;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
use App\Enums\GuestStatus;
use App\Http\Requests\Bookings\BookingsUpdateRequest;
use App\Models\Booking;
use App\Services\BookingService;
use App\Services\GuestService;
use App\Services\OpenScheduleService;
use App\Services\PackageService;
use App\Services\RecommendationService;
use Carbon\Carbon;
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
        $dataAgora = Carbon::now()->locale('pt-BR');
        
        // Lista somente as próximas reservas
        $bookings = $this->service->paginate_next_bookings(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5));
        $min_days = $this->service::$min_days;

        $current_party = null;

        foreach($bookings->items() as $key => $booking)
        {
            $booking_start = \Illuminate\Support\Carbon::parse($booking->party_day . ' ' . $booking->open_schedule['time']);
            $booking_end = \Illuminate\Support\Carbon::parse($booking->party_day . ' ' . $booking->open_schedule['time']);
            $booking_end->addHours($booking->open_schedule['hours']);

            if($dataAgora < $booking_end && $dataAgora > $booking_start){
                $current_party = $booking;
                break;
            }

        }

        return view('bookings.index', compact('bookings', 'min_days', 'current_party'));
    }

    public function party_mode(string $id, Request $request) {
        if (!$booking = $this->service->find($id)) {
            return redirect()->route('bookings.not_found');
        }

        $user = auth()->user();
        if($user->hasRole('user') && $user->id !== $booking->user_id) {
            // Todos podem acessar as reservas, desde que não seja um usuário comum e que este usuário seja diferente do usuário da reserva
            abort(403);
        }

        $guests = $this->guests->getByBookingPaginate(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), id: $id);       

        $unblockGuests = [];
        foreach ($guests->items() as $guest) {
            if (!($this->filterGuestBlocked($guest))) {
                $unblockGuests[] = $guest;
            }
        }


        $arrivedGuests = [];
        foreach ($guests->items() as $guest) {
            if ($this->filterGuestArrived($guest)) {
                $arrivedGuests[] = $guest;
            }
        }
        
        $guest_counter = ['arrived'=>count($arrivedGuests), 'unblocked'=>count($unblockGuests)];

        return view('bookings.party_mode', compact('booking', 'guests', 'guest_counter'));
    }

    public function create()
    {
        $packages = $this->package->getAllByStatus(true);

        return view('bookings.create', compact('packages'));
    }

    private function filterGuestConfirmed($guest)
    {
        return $guest->status == GuestStatus::C->name;
    }

    private function filterGuestArrived($guest)
    {
        return $guest->status == GuestStatus::P->name;
    }

    private function filterGuestBlocked($guest)
    {
        return $guest->status == GuestStatus::B->name;
    }
    
    public function find(string $id, Request $request)
    {
        if (!$booking = $this->service->find($id)) {
            return redirect()->route('bookings.not_found');
        }

        $user = auth()->user();
        if($user->hasRole('user') && $user->id !== $booking->user_id) {
            // Todos podem acessar as reservas, desde que não seja um usuário comum e que este usuário seja diferente do usuário da reserva
            abort(403);
        }

        $recommendations = $this->recommendations->getAll();
        $recommendations = array_slice($recommendations, 0, 10);

        $guests = $this->guests->getByBookingPaginate(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), id: $id);
        
        $unblockGuests = [];
        foreach ($guests->items() as $guest) {
            if (!($this->filterGuestBlocked($guest))) {
                $unblockGuests[] = $guest;
            }
        }
        
        $confirmedGuests = [];
        $arrivedGuests = [];
        foreach ($guests->items() as $guest) {
            if ($this->filterGuestArrived($guest)) {
                $arrivedGuests[] = $guest;
            } else if($this->filterGuestConfirmed($guest)) {
                $confirmedGuests[] = $guest;
            }
        }
        
        $guest_counter = ['arrived'=>count($arrivedGuests), 'unblocked'=>count($unblockGuests), 'total'=>count($arrivedGuests)+count($confirmedGuests)];
    
        return view('bookings.show', compact('booking', 'recommendations', 'guests', 'guest_counter'));
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

        $user = auth()->user();
        if(($user->hasRole('user') || $user->hasRole('operational')) && $user->id !== $booking->user_id) {
            // Todos podem acessar as reservas, desde que não seja um usuário comum e que este usuário seja diferente do usuário da reserva
            abort(403);
        }

        $packages = $this->package->getAllByStatus(true);


        return view('bookings.update', compact('booking','packages'));
    }

    public function update(BookingsUpdateRequest $request)
    {        
        $retornos = new MessageBag();
    
        try {
            $booking = $this->service->find($request->id);
            $request->status = $request->status ?? $booking->status;
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