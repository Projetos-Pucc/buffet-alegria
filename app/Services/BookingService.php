<?php

namespace App\Services;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Repositories\Contract\BookingRepository;
use stdClass;

class BookingService {

    public function __construct(
        protected BookingRepository $booking

    ){}
    
    public function create(CreateBookingDTO $dto) {        
        return $this->booking->create($dto);
    }

    public function getAll(): array {
        return $this->booking->getAll();
    }

    public function find($id) {
        return $this->booking->findOneById($id);
    }

    public function delete($id) {
        $this->booking->delete($id);
    }
    public function update(UpdateBookingDTO $dto) {
        return $this->booking->update($dto);
    }
    
}