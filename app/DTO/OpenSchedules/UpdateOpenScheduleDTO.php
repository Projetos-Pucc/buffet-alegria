<?php

namespace App\DTO\Bookings;

use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;

class UpdateOpenScheduleDTO {
    public function __construct(
        public int $id,
    ) {}

    public static function makeFromRequest(OpenSchedulesUpdateRequest $request):self {
        return new self(
            $request->id
        );
    }
}