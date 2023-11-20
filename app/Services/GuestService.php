<?php

namespace App\Services;

use App\DTO\Guests\UpdateGuestDTO;
use App\DTO\Guests\CreateGuestDTO;
use App\DTO\Guests\GuestDTO;
use App\Enums\GuestStatus;
use App\Repositories\Contract\GuestRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class GuestService
{

    public function __construct(
        protected GuestRepository $guest

    ) {
    }

    public function updateStatus($id, $status)
    {
        return $this->guest->updateStatus($id,$status);
    }

    public function create(CreateGuestDTO $dto, GuestStatus $status=GuestStatus::E)
    {
        $rows = [];
        foreach ($dto->rows as $value) {
            $data = [
                "nome" => $value['nome'],
                "cpf" => $value['cpf'],
                "idade" => $value['idade'],
                "status" => $status->name,
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

    public function paginate(
        int $page=1,
        int $totalPerPage=15,
        string $filter = null
    ): LengthAwarePaginator
    {
        return $this->guest->paginate(page: $page, totalPerPage: $totalPerPage, filter: $filter);
    }

    public function getByBookingPaginate(string $id, int $page=1, int $totalPerPage=15, string $filter = null) {
        return $this->guest->getByBookingPaginate(page: $page, totalPerPage: $totalPerPage, filter: $filter, id: $id);
    }
    public function getByBooking(string $id) {
        return $this->guest->getByBooking(id: $id);
    }

}
