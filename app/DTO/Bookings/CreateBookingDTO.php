<?php

namespace App\DTO\Bookings;

use App\Enums\BookingStatus;
use App\Http\Requests\Bookings\BookingsUpdateRequest;
use DateTime;

class CreateBookingDTO {
    public function __construct(
        public string $name_birthdayperson,
        public string $years_birthdayperson,
        public int $qnt_invited,
        public int $user_id, 
        public int $package_id,
        public DateTime $party_start,
        public DateTime $party_end,
        public string $status,
        public float $price=0,
    ) {}

    public static function makeFromRequest(BookingsUpdateRequest $request):self {
        return new self(
            $request->name_birthdayperson,
            $request->years_birthdayperson,
            (int)$request->qnt_invited,
            (int)$request->user_id ?? auth()->user()->id,
            (int)$request->package_id,
            new DateTime($request->party_start),
            new DateTime($request->party_end),
            $request->status ?? BookingStatus::P->name,
        );
    }
}