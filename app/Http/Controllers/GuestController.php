<?php

namespace App\Http\Controllers;

use App\DTO\Guests\CreateGuestDTO;
use App\DTO\Guests\UpdateGuestDTO;
use App\Http\Requests\Guests\GuestsUpdateRequest;
use App\Services\GuestService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct(
        protected GuestService $service
    )
    {}

    public function index()
    {
        $guests = $this->service->getAll();

        return view('guests.index',compact('guests'));

    }

    public function create()
    {
        return view('guests.create');

    }

    public function find(string $id)
    {
        if(!$guests = $this->service->find($id)){
            return back();
        }
        return view('gusets.show',compact('guest'));
    }

    public function store(GuestsUpdateRequest $request)
    {
        $this->service->create(CreateGuestDTO::makeFromRequest($request));

        return redirect()->route('guests.index');
    }

    public function delete(Request $request)
    {
        $this->service->delete($request->id);

        return redirect()->route('gusets.index');

    }

    public function update(GuestsUpdateRequest $request)
    {
        $guest = $this->service->update(
            UpdateGuestDTO::makeFromRequest($request)
        );
        if(!$guest){
            return back();
        }
        
        return redirect()->route('guests.index');
    }

    public function edit(Request $request)
    {
        if(!$guest = $this->service->find($request->id)) {
            return back();
        }

        return view('guests.update',compact('guest'));
    }
    
}
