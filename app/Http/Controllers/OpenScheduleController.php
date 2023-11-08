<?php

namespace App\Http\Controllers;

use App\DTO\OpenSchedules\CreateOpenScheduleDTO;
use App\DTO\OpenSchedules\UpdateOpenScheduleDTO;
use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;
use App\Services\OpenScheduleService;
use DateTime;
use Error;
use Illuminate\Http\Request;

class OpenScheduleController extends Controller
{
    public function __construct(
        protected OpenScheduleService $open_schedules
    )
    {}

    public function getSchedulesByDay(Request $request) {
        $dataFormatada = DateTime::createFromFormat("Y-m-d", $request->day);
        if(!$dataFormatada) throw new Error('Invalid time');

        $update = $request->query('update'); // Se existir valor para update retorna o dia junto
        if(isset($update)) {
            $schedules = $this->open_schedules->getSchedulesByDayUpdate($dataFormatada, (int) $update);
        } else {
            $schedules = $this->open_schedules->getSchedulesByDay($dataFormatada);
        }

        return response()->json($schedules);
    }

    public function index(){
        $schedules = $this->open_schedules->getAll();

        return view('schedules.index', compact('schedules'));
    }
    public function create()
    {
        return view('schedules.create');
    }
    public function find(string $id)
    {
        if(!$recommendation = $this->open_schedules->find($id)){
            return back();
        }
        return view('recommendations.show', compact('recommendation'));
    }
    public function store(OpenSchedulesUpdateRequest $request){
        $this->open_schedules->create(CreateOpenScheduleDTO::makeFromRequest($request));

        return redirect()->route('schedules.index');
    }
    public function delete(Request $request){
        $this->open_schedules->delete($request->id);

        return redirect()->route('schedules.index');
    }
    public function edit(Request $request)
    {
        if (!$schedule = $this->open_schedules->find($request->id)) {
            return back();
        }

        return view('schedules.update', compact('schedule'));
    }
    public function update(OpenSchedulesUpdateRequest $request)
    {
        $this->open_schedules->update(UpdateOpenScheduleDTO::makeFromRequest($request));
        return redirect()->route('recommendations.index');
    }
}
