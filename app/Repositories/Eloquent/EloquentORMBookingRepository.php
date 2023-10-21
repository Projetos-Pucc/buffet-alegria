<?php

namespace App\Repositories\Eloquent;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Models\Booking;
use App\Repositories\Contract\BookingRepository;
use stdClass;

class EloquentORMBookingRepository implements BookingRepository {
    public function __construct(
        protected Booking $booking
    ){}

    public function getAll(string $filter = null): array {
        return $this->booking->with('package')->with('user')->get()->toArray();
    }

    public function findOneById(string $id): stdClass|null {
        $booking = $this->booking->find($id);
        if (!$booking) {
            return null;
        }
        return (object) $booking->toArray();
    }

    public function delete(string $id): void {
        //validate if booking exists
        $this->booking->delete($id);
    }

    public function create(CreateBookingDTO $dto): stdClass {
        $booking = $this->booking->create((array)$dto);
        return (object)$booking->toArray();
    }
    
    public function update(UpdateBookingDTO $dto): stdClass|null {
        if(!$booking = $this->booking->find($dto->id)){
            return null;
        }
        $booking->update((array)$dto);
    }

    public function findOne(...$filters): stdClass|null {
        $booking = $this->booking->get()->where(...$filters);
        if (!$booking) {
            return null;
        }
        return (object) $booking->toArray();
    }
}