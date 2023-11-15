<?php

namespace App\Services;

use App\DTO\Guests\UpdateGuestDTO;
use App\DTO\Guests\CreateGuestDTO;
use App\DTO\Guests\GuestDTO;
use App\Enums\GuestStatus;
use App\Repositories\Contract\GuestRepository;


class GuestService
{

    public function __construct(
        protected GuestRepository $guest

    ) {
    }

    public function create(CreateGuestDTO $dto)
    {
        $rows = [];
        foreach ($dto->rows as $value) {
            $data = [
                "nome" => $value['nome'],
                "cpf" => $value['cpf'],
                "idade" => $value['idade'],
                "status" => GuestStatus::E->name,
                "booking_id" => $dto->booking_id
            ];
            
            array_push($rows, $this->guest->create(new GuestDTO(...$data)));
        }
        $response = [
            'booking_id'=>$dto->booking_id,
            'rows'=>$rows
        ];

        return $response;
        
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

}
