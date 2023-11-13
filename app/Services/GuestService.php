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
        $data = [
        "nome"=>$dto->nome,
        "cpf"=>$dto->cpf,
        "idade"=>$dto->idade,
        "status"=>GuestStatus::N->name,
        "booking_id"=>$dto->booking_id
        ];
        return $this->guest->create(new CreateGuestDTO(...$data));

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
        $data = [
            "id"=>$dto->id,
            "nome"=>$dto->nome,
            "cpf"=>$dto->cpf,
            "idade"=>$dto->idade,
            "status"=>GuestStatus::N->name,
            "booking_id"=>$dto->booking_id
            ];
            return $this->guest->update(new UpdateGuestDTO(...$data));

    }
}