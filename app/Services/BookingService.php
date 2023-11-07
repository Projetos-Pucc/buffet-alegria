<?php

namespace App\Services;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\OpenScheduleRepository;
use App\Repositories\Contract\PackageRepository;
use DateTime;
use stdClass;
use TypeError;

class BookingService
{
    
    public function __construct(
        protected BookingRepository $booking,
        protected PackageRepository $package,
        protected OpenScheduleRepository $open_schedule

    ) {
    }
    private function validate(CreateBookingDTO | UpdateBookingDTO $dto)
    {
        $hour = $this->validate_hour($dto->open_schedule_id);
        $this->validate_day($dto->party_day, $hour->time, $hour->hours);
        $this->validate_package($dto->package_id);
        // $booking_exists = $this->validate_booking_exists_in_time($dto->party_start, $hour->time);
        
        // if($booking_exists) {
        //     if((isset ($dto->id) and $booking_exists->id != $dto->id) or !isset($dto->id)){
        //         //SE existir um id é o Update, caso NÃO exista é Create
        //         throw new TypeError("Party already exists in this time");
        //     }
        // }

    }
    private function format_price(float $package_price, int $qnt_invited)
    {
        return $qnt_invited * $package_price;
    }

    private function format_booking_date(DateTime $partyDay, string $partyStart, int $addHours){
        $partyDay->format('Y-m-d');

        $todayDate = date('Y-m-d');

        $maxDate = new DateTime(date('Y-m-d', strtotime($todayDate . " +".self::$min_days." days")));

        $p = $partyDay;
        
        list($horas, $minutos, $segundos) = explode(':', $partyStart);
        $partyEnd = $p->setTime($horas, $minutos, $segundos);

        return ['party_day'=>$partyDay,'today_date'=>$todayDate,'max_date'=>$maxDate,'party_end'=>$partyEnd];

    }

    private function validate_hour(string $hour) {
        $valid = $this->open_schedule->findByHour($hour);
        if(!$valid) {
            throw new TypeError('Hour not valid');
        }
        return $valid;
    }

    private function validate_day(DateTime $partyDay, string $partyStart, int $addHours)
    {
        ['party_day'=>$partyDate,'party_end'=>$partyEnd,'max_date'=>$maxDate]= $this->format_booking_date($partyDay, $partyStart, $addHours);

        if ($partyDate <= $maxDate) {
            throw new TypeError("Party should be scheduled with a minimum of ".self::$min_days." days");
        }

        if($partyEnd < $partyDate) {
            throw new TypeError('Party can not end before start');
        }

    }

    private function validate_package(int $id_package)
    {
        $package = $this->package->findOneById($id_package);
        
        if(!$package) {
            throw new TypeError("Package not found");
        }
        
    }

    private function validate_booking_exists_in_time(DateTime $partyDate, string $hour)
    {
        $a = $this->open_schedule->getClosedSchedulesByDay($partyDate);
        return $this->booking->findOne('party_start', $partyDate);
    }

    public static int $min_days = 5; //numero minimo de dias para poder criar uma festa

    public function create(CreateBookingDTO $dto)
    {
        try{

            $this->validate($dto);

            $data = [
            "name_birthdayperson"=>$dto->name_birthdayperson,
            "years_birthdayperson"=>$dto->years_birthdayperson,
            "qnt_invited"=>$dto->qnt_invited,
            "party_day"=>$dto->party_day,
            "open_schedule_id"=>$dto->open_schedule_id,
            "status"=>BookingStatus::P->name,
            "user_id"=>auth()->user()->id,
            "package_id"=>$dto->package_id,
            "price"=>$this->format_price($this->package->findOneById($dto->package_id)->price,$dto->qnt_invited),
            ];

            return $this->booking->create(new CreateBookingDTO(...$data));

        }catch(TypeError $error)
        {
            throw $error;
        }
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
    
    public function update(UpdateBookingDTO $dto)
    {
        try{
            $this->validate($dto);
            // ['partyDay'=>$partyDay] = $this->format_booking_date($dto->party_start);

            // $data = [
            // "id"=>$dto->id,
            // "name_birthdayperson"=>$dto->name_birthdayperson,
            // "years_birthdayperson"=>$dto->years_birthdayperson,
            // "qnt_invited"=>$dto->qnt_invited,
            // "party_day"=>$partyDay,
            // "status"=>BookingStatus::P->name,
            // "user_id"=>auth()->user()->id,
            // "package_id"=>$dto->package_id,
            // "price"=>$this->format_price($this->package->findOneById($dto->package_id)->price,$dto->qnt_invited),
            // ];

            // return $this->booking->update(new UpdateBookingDTO(...$data));

        }catch(TypeError $error){
            throw $error;
        }
    }
}

//party_date --> party_day
//party_end XXXXXX
//party_time ++++++