<?php

namespace App\Repositories\Eloquent;

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

    public function findByHour(string $hour): stdClass {
        return (object)$this->open_schedules->find((int)$hour)->toArray();
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
}
