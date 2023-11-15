<?php

namespace App\DTO\OpenSchedules;

use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;

class CreateOpenScheduleDTO {
    public function __construct(
        public string $time,
        public int $hours
    ) {}

    public static function makeFromRequest(OpenSchedulesUpdateRequest $request):self {
        return new self(
            $request->time,
            $request->hours
        );
    }
}