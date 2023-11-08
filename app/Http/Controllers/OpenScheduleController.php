<?php

namespace App\Http\Controllers;

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
    public function find(string $id){}
    public function store(){}
    public function delete(Request $request){}
    public function edit(Request $request){}
    public function update(){}
}
