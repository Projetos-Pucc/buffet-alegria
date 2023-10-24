<?php

namespace App\Services;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\PackageRepository;
use DateTime;
use stdClass;
use TypeError;

class BookingService
{

    public function __construct(
        protected BookingRepository $booking,
        protected PackageRepository $package

    ) {
    }

    public static int $min_days = 5; //numero minimo de dias para poder criar uma festa

    public function create(CreateBookingDTO $dto)
    {
        // validar se a data é menor que hoje + min_days (5 dias)
        $partyDate = $dto->party_start;
        $partyDate->format('Y-m-d H:i:s');

        $partyEnd = $dto->party_end;
        $partyEnd->format('Y-m-d H:i:s');

        $todayDate = date('Y-m-d H:i:s');
        
        $maxDate = new DateTime(date('Y-m-d H:i:s', strtotime($todayDate . " +".self::$min_days." days")));
        
        if ($partyDate <= $maxDate) {
            throw new TypeError("Party should be scheduled with a minimum of ".self::$min_days." days");
        }

        if($partyEnd > $partyDate) {
            throw new TypeError('Party can not end before start');
        }
        
        // validar se a data ja existe
        $booking_exists = $this->booking->findOne('party_start', $partyDate);
        if($booking_exists) {
            // TODO: validar se o status esta confirmado antes
            throw new TypeError("Party already exists in this time");
        }

        
        $package = $this->package->findOneById($dto->package_id);
        
        if(!$package) {
            throw new TypeError("Package not found");
        }
        
        $price = $dto->qnt_invited * $package->price;
        
        // $user_id = auth()->user()->id;
        // $request->user_id = $user_id;
        // $request->price = $price;
        // $request->status = BookingStatus::fromValue('P');
        
        $data = [
            "name_birthdayperson"=>$dto->name_birthdayperson,
            "years_birthdayperson"=>$dto->years_birthdayperson,
            "qnt_invited"=>$dto->qnt_invited,
            "party_start"=>$partyDate,
            "party_end"=>$partyEnd,
            "status"=>BookingStatus::P->name,
            "user_id"=>auth()->user()->id,
            "package_id"=>$package->id,
            "price"=>$price,
        ];

        
        // $booking->create((array)$data);
        return $this->booking->create(new CreateBookingDTO(...$data));
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
        $this->booking->delete($id);
    }
    public function update(UpdateBookingDTO $dto)
    {
        return $this->booking->update($dto);
    }
}
