<?php

namespace App\Services;

use App\DTO\Guests\UpdateGuestDTO;
use App\DTO\Guests\CreateGuestDTO;
use App\Enums\GuestStatus;
use App\Repositories\Contract\GuestRepository;


class GuestService
{
    
    public function __construct(
        protected GuestRepository $guest

    ) {}

    public function create(CreateGuestDTO $dto)
    {

    }

    public function getAll(): array
    {
        return $this->guest->getAll();
    }

    public function find($id)
    {
        return $this->guest->findOneById($id);
    }

    public function delete($id)
    {
        return $this->guest->delete($id);
    }

    public function update(UpdateGuestDTO $dto)
    {

    }
}