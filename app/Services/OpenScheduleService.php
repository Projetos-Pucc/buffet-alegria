<?php

namespace App\Services;

use App\Repositories\Contract\OpenScheduleRepository;
use DateTime;

class OpenScheduleService
{
    
    public function __construct(
        protected OpenScheduleRepository $open_schedules

    ) {
    }

    public function getSchedulesByDay(DateTime $day): array  {
        return $this->open_schedules->getOpenSchedulesByDay($day);
    }

}