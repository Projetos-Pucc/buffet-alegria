<?php

namespace App\Services;

use App\DTO\Guests\UpdateGuestDTO;
use App\DTO\Guests\CreateGuestDTO;
use App\Enums\GuestStatus;
use App\Repositories\Contract\GuestRepository;
use DateTime;
use stdClass;
use TypeError;

class BookingService
{
    
    public function __construct(
        protected GuestRepository $booking

    ) {}

    public function create(CreateGuestDTO $dto)
    {

    }

    public function getAll(): array
    {
        return $this->booking->getAll();
    }

    public function find($id)
    {
        return $this->booking->findOneById($id);
    }

    public function delete($id)
    {
        return $this->booking->delete($id);
    }
    public function update(UpdateGuestDTO $dto)
    {

    }
}