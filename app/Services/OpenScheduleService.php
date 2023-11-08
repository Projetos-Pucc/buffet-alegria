<?php

namespace App\Services;

use App\DTO\OpenSchedules\CreateOpenScheduleDTO;
use App\DTO\OpenSchedules\UpdateOpenScheduleDTO;
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
    public function create(CreateOpenScheduleDTO $dto)
    {
        return $this->open_schedules->create($dto);
    }

    public function delete($id)
    {
        return $this->open_schedules->delete($id);
    }

    public function update(UpdateOpenScheduleDTO $dto)
    {
        
        return $this->open_schedules->update($dto);
    }

}