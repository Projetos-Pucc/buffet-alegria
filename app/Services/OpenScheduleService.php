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

    public function getSchedulesByDayUpdate(DateTime $day, int $booking_id): array  {
        return $this->open_schedules->getOpenSchedulesByDayUpdate($day, $booking_id);
    }

    public function getAll(): array {
        return $this->open_schedules->getAll();
    }

    public function find($id) {
        return $this->open_schedules->findOneById($id);
    }

}