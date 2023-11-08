<?php

namespace App\Repositories\Eloquent;

use App\DTO\Bookings\CreateOpenScheduleDTO;
use App\DTO\Bookings\UpdateOpenScheduleDTO;
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

    public function getAll(string $filter = null): array {
        return $this->open_schedules->get()->toArray();
    }
    public function findOneById(string $id): stdClass|null {
        return null;
    }
    public function findOne(...$filters): stdClass|null {
        return null;
    }
    public function delete(string $id): bool|null {
        return null;
    }
    public function create(CreateOpenScheduleDTO $dto): stdClass {
        return (object)[];
    }
    public function update(UpdateOpenScheduleDTO $dto): bool|null {
        return null;
    }
}
