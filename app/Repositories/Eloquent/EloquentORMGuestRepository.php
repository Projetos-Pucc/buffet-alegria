<?php

namespace App\Repositories\Eloquent;

use App\DTO\Guests\CreateGuestDTO;
use App\DTO\Guests\GuestDTO;
use App\DTO\Guests\UpdateGuestDTO;
use App\Models\Guest;
use App\Repositories\Contract\GuestRepository;
use stdClass;

class EloquentORMGuestRepository implements GuestRepository {
    public function __construct(
        protected Guest $guest
    ){}

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