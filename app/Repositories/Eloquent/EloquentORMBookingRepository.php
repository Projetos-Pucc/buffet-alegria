<?php

namespace App\Repositories\Eloquent;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Models\Booking;
use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\PaginationInterface;
use App\Repositories\Presenters\PaginationPresenter;
use stdClass;

class EloquentORMBookingRepository implements BookingRepository {
    public function __construct(
        protected Booking $booking
    ){}

    public function getAll(string $filter = null): array {
        return $this->booking->with(['open_schedule'=>function ($query) {
            $query->orderBy('time', 'asc');
        }, 'package', 'user'])->orderBy('party_day', 'asc')->get()->toArray();
    }

    public function findOneById(string $id): stdClass|null {
        $booking = $this->booking->with('package')->with('user')->find($id);
        if (!$booking) {
            return null;
        }
        return (object) $booking->toArray();
    }

    public function delete(string $id): bool|null {
        //validate if booking exists
        if (!$this->findOneById($id)) {
            return null;
        }
        return $this->booking->destroy($id);
    }

    public function create(CreateBookingDTO $dto): stdClass {
        $booking = $this->booking->create((array)$dto);
        return (object)$booking->toArray();
    }
    
    public function update(UpdateBookingDTO $dto): bool|null {
        if(!$booking = $this->booking->find($dto->id)){
            return null;
        }
        return $booking->update((array)$dto);
    }

    public function findOne(...$filters): stdClass|null {
        $booking = $this->booking->with('package')->with('user')->where(...$filters)->get()->first();
        if (!$booking) {
            return null;
        }
        return (object) $booking->toArray();
    }

    public function findByUser(int $userId): array {
        return $this->booking->with(['open_schedule'=>function ($query) {
            $query->orderBy('time', 'asc');
        }, 'package', 'user'])->where('user_id', $userId)->orderBy('party_day', 'asc')->get()->toArray();
    }

    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): PaginationInterface {
        $result = $this->booking->with(['open_schedule'=>function ($query) {
            $query->orderBy('time', 'asc');
        }, 'package', 'user'])->orderBy('party_day', 'asc')->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }

}