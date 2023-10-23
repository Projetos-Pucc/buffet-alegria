<?php

namespace App\DTO\Bookings;

use App\Http\Requests\Bookings\BookingsUpdateRequest;

class UpdateBookingDTO extends CreateBookingDTO {
    public function __construct(
        public string $name_birthdayperson,
        public string $years_birthdayperson,
        public int $qnt_invited,
        public int $id_reservations,
        public int $id_packages,
        public string $status,
        public int $user_id, 
        public int $packages,
        public float $prices, 
    ) {}

    public static function makeFromRequest(BookingsUpdateRequest $request):self {
        return new self($request->name_birthdayperson,
        $request->years_birthdayperson,
        (int)$request->qnt_invited,
        (int)$request->id_reservations,
        (int)$request->id_packages,
        $request->status,
        (int)$request->user_id,
        (int)$request->packages,
        $request->prices,
    );
    }
}