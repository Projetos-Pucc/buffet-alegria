<?php

namespace App\DTO\Bookings;

use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;

class CreateOpenScheduleDTO {
    public function __construct(
    ) {}

    public static function makeFromRequest(OpenSchedulesUpdateRequest $request):self {
        return new self(
        );
    }
}