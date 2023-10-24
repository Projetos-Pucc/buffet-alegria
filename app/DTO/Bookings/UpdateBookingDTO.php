<?php

namespace App\DTO\Bookings;

use App\Enums\BookingStatus;
use App\Http\Requests\Bookings\BookingsUpdateRequest;
use DateTime;

class UpdateBookingDTO {
    public function __construct(
        public int $id,
        public string $name_birthdayperson,
        public string $years_birthdayperson,
        public int $qnt_invited,
        public float $price, 
        public string $status,
        public int $user_id, 
        public int $package_id,
        public DateTime $party_start,
        public DateTime $party_end,
    ) {}

    public static function makeFromRequest(BookingsUpdateRequest $request):self {
        return new self(
            $request->id,
            $request->name_birthdayperson,
            $request->years_birthdayperson,
            (int)$request->qnt_invited,
            $request->prices,
            $request->status ?? BookingStatus::P->name,
            (int)$request->user_id,
            (int)$request->package_id,
            $request->party_start,
            $request->party_end
        );
    }
}