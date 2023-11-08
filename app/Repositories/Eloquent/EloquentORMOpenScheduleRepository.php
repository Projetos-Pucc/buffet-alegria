<?php

namespace App\Repositories\Eloquent;

use App\DTO\OpenSchedules\CreateOpenScheduleDTO;
use App\DTO\OpenSchedules\UpdateOpenScheduleDTO;
use App\Models\Booking;
use App\Models\OpenSchedule;
use App\Repositories\Contract\OpenScheduleRepository;
use DateTime;
use stdClass;

class EloquentORMOpenScheduleRepository implements OpenScheduleRepository
{
    public function __construct(
        protected OpenSchedule $open_schedules,
        protected Booking $bookings,
    ) {
    }

    public function getOpenSchedulesByDay(DateTime $day): array
    {
        $day = $day->format('Y-m-d');
        return $this->open_schedules
            ->leftJoin('bookings', function ($join) use ($day) {
                $join->on('open_schedules.id', '=', 'bookings.open_schedule_id')
                    ->where('bookings.party_day', '=', $day);
            })
            ->whereNull('bookings.open_schedule_id')
            ->select('open_schedules.*')
            ->get()
            ->toArray();
    }

    public function getOpenSchedulesByDayUpdate(DateTime $day, int $booking_id): array
    {
        $day = $day->format('Y-m-d');
        return $this->open_schedules
            ->leftJoin('bookings', function ($join) use ($day) {
                $join->on('open_schedules.id', '=', 'bookings.open_schedule_id')
                    ->where('bookings.party_day', '=', $day);
            })
            ->where(function ($query) use ($booking_id) {
                $query->whereNull('bookings.open_schedule_id')
                    ->orWhere('bookings.id', '=', $booking_id);
            })
            ->select('open_schedules.*')
            ->get()
            ->map(function ($item) use ($booking_id) {
                if ($item->id === $booking_id) {
                    $item->special_id = $item->id;
                } else {
                    $item->special_id = null;
                }
                return $item;
            })
            ->toArray();
    }

    public function findByHour(string $hour): stdClass|null {
        $schedule = $this->open_schedules->where('time', $hour)->get()->first();
        if(!$schedule) return null;
        return (object)$schedule->toArray();
    }
    
    public function getClosedSchedulesByDay(DateTime $day): array
    {   
        // $day = $day->format('Y-m-d');
        // return $this->open_schedules
        //     ->join('bookings', function ($join) use ($day) {
        //         $join->on('open_schedules.id', '=', 'bookings.open_schedule_id')
        //             ->where('bookings.party_day', '=', $day);
        //     })
        //     ->select('open_schedules.*')
        //     ->get()
        //     ->toArray();
        return [];
        
    }

    public function findByDayAndHour(DateTime $day, string $hour): stdClass|null {
        // $day = $day->format('Y-m-d');
        
        // return (object)$this->open_schedules
        //     ->innerJoin('bookings', function ($join) use ($day) {
        //         $join->on('open_schedules.id', '=', 'bookings.open_schedule_id')
        //             ->where('bookings.party_day', '=', $day);
        //     })
        //     ->whereNull('bookings.open_schedule_id')
        //     ->select('open_schedules.*')
        //     ->get()
        //     ->toArray();
        return (object)[];
    }

    public function getAll(string $filter = null): array {
        return $this->open_schedules->get()->toArray();
    }
    public function findOneById(string $id): ?stdClass
    {
        $open_schedules = $this->open_schedules->find($id);
        if(!$open_schedules){
            return null;
        }
        return (object) $open_schedules->toArray();
    }

    public function findOne(...$filters): ?stdClass
    {
        $open_schedules = $this->open_schedules->get()->where(...$filters)->first();
        if(!$open_schedules){
            return null;
        }
        return (object) $open_schedules->toArray();
    }

    public function create(CreateOpenScheduleDTO $dto): stdClass
    {
        $open_schedules = $this->open_schedules->create((array)$dto);
        return (object)$open_schedules->toArray();
        
    }

    public function update(UpdateOpenScheduleDTO $dto): ?bool
    {
        if(!$open_schedules = $this->open_schedules->find($dto->id )){
            return null;
        }

        return $open_schedules->update((array)$dto);
    }

    public function delete(string $id): bool|null
    {
        if(!$this->findOneById($id)){
            return null;
        }
        return $this->open_schedules->destroy($id);
        
    }

}
