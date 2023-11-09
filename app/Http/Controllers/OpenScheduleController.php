<?php

namespace App\Http\Controllers;

use App\DTO\OpenSchedules\CreateOpenScheduleDTO;
use App\DTO\OpenSchedules\UpdateOpenScheduleDTO;
use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;
use App\Services\OpenScheduleService;
use DateTime;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use TypeError;

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
        if(!$schedule = $this->open_schedules->find($id)){
            return back();
        }
        return view('schedules.show', compact('schedule'));
    }
    public function store(OpenSchedulesUpdateRequest $request){
        $retornos = new MessageBag();
    
        try {
            $schedule = $this->open_schedules->create(CreateOpenScheduleDTO::makeFromRequest($request));
            $retornos->add('msg', 'Horario atualizado com sucesso!');
            return redirect()->route('schedules.show', $schedule->id);
        } catch (TypeError $e) {
            // Captura uma exceção de tipo (TypeError)
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        } catch (mixed $e) {
            // Captura outras exceções
            $retornos->add('errors', $e->getMessage());
            return back()->withErrors($retornos);
        }
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
        $retornos = new MessageBag();
    
        try {
            $this->open_schedules->update(UpdateOpenScheduleDTO::makeFromRequest($request));
            $retornos->add('msg', 'Horario atualizado com sucesso!');
            return redirect()->route('schedules.show', $request->id);
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
}
