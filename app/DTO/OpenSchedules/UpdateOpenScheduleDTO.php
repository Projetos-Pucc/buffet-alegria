<?php

namespace App\DTO\OpenSchedules;

use App\Http\Requests\OpenSchedules\OpenSchedulesUpdateRequest;

class UpdateOpenScheduleDTO {
    public function __construct(
        public int $id,
        public string $time,
        public int $hours,
        public bool $status,
    ) {}

    public static function makeFromRequest(OpenSchedulesUpdateRequest $request):self {
        return new self(
            $request->id,
            $request->time,
            (int)$request->hours,
            $request->status ?? true
        );
    }
}