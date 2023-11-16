<?php

namespace App\Repositories\Eloquent;

use App\DTO\Guests\CreateGuestDTO;
use App\DTO\Guests\GuestDTO;
use App\DTO\Guests\UpdateGuestDTO;
use App\Models\Guest;
use App\Repositories\Contract\GuestRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class EloquentORMGuestRepository implements GuestRepository {
    public function __construct(
        protected Guest $guest
    ){}

    public function getByBookingPaginate(string $id, int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator{
        return $this->guest
        ->where('booking_id', $id)
        ->with('booking')
        ->paginate($totalPerPage, ['*'], 'page', $page);
    }

    // Remover a função getByBookingPaginate e otimizar o filter, de forma a usar apenas a função paginate.

    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator{
        return $this->guest
        ->where(function($query) use ($filter){
            if($filter){
                $query->where('nome', 'like', "%{$filter}%");
                $query->orWhere('cpf', 'like', "%{$filter}%");
                $query->orWhere('idade', 'like', "%{$filter}%");
                $query->orWhere('status', $filter);
                $query->orWhere('booking_id', $filter);  
            }
        })
        ->with('booking')
        ->paginate($totalPerPage, ['*'], 'page', $page);
    }

    public function getAll(string $filter = null): array {

        return $this->guest
        ->where(function($query) use ($filter){
            if($filter){
                $query->where('nome', 'like', "%{$filter}%");
                $query->orWhere('cpf', 'like', "%{$filter}%");
                $query->orWhere('idade', 'like', "%{$filter}%");
                $query->orWhere('status', 'like', "%{$filter}%");
                $query->orWhere('booking_id','like',"%{$filter}%");  
            }
        })
        ->with('booking')
        ->get()->toArray();
    }

    public function findOneById(string $id): stdClass|null 
    {
        $guest= $this->guest->find($id);
        if(!$guest){
            return null;
        }
        return (object) $guest->toArray();
    }

    public function delete(string $id): void
    {
        $this->guest->destroy($id);
    }

    public function create(GuestDTO $dto): stdClass
    {
        $guest = $this->guest->create((array)$dto);
        return (object)$guest->toArray();
    }
    
    public function findOne(...$filters): stdClass|null 
    {
        $guest = $this->guest->get()->where(...$filters)->first();
        if(!$guest){
            return null;
        }
        return (object) $guest->toArray();

    }

}