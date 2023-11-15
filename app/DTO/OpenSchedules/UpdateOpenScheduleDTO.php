<?php

namespace App\DTO\OpenSchedules;

use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;

class UpdateOpenScheduleDTO {
    public function __construct(
        public int $id,
        public string $time,
        public int $hours
    ) {}

    public static function makeFromRequest(OpenSchedulesUpdateRequest $request):self {
        return new self(
            $request->id,
            $request->time,
            (int)$request->hours
        );
    }
}