<?php

namespace App\DTO\OpenSchedules;

use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;

class CreateOpenScheduleDTO {
    public function __construct(
        public string $time,
        public int $hours,
        public bool $status,
    ) {}

    public static function makeFromRequest(OpenSchedulesUpdateRequest $request):self {
        return new self(
            $request->time,
            $request->hours,
            $request->status ?? true
        );
    }
}