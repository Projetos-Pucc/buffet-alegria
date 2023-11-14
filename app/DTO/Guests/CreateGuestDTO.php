<?php

namespace App\DTO\Guests;

use App\Enums\GuestStatus;
use App\Http\Requests\Guests\GuestsUpdateRequest;

class CreateGuestDTO {
    public function __construct(
        public string $nome,
        public string $cpf,
        public int $idade,
        public string $status,
        public int $booking_id
    ) {}

    public static function makeFromRequest(GuestsUpdateRequest $request):self {
        return new self($request->nome,
        $request->cpf,
        (int)$request->idade,
        $request->status ?? GuestStatus::E->name,
        (int)$request->booking_id

        );
    }
}