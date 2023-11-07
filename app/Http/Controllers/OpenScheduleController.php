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
        if(!$dataFormatada) throw new Error('nao deu');
        $schedules = $this->open_schedules->getSchedulesByDay($dataFormatada);
        return response()->json($schedules);
    }
}
