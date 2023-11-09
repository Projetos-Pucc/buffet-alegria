<?php

namespace App\DTO\Guests;

use App\Http\Requests\Guests\GuestsUpdateRequest;

class UpdateGuestDTO {
    public function __construct(
        public string $id,
        public string $nome,
        public string $cpf,
        public int $idade,
        public string $status,
        public int $booking_id
    ) {}

    public static function makeFromRequest(GuestsUpdateRequest $request):self {
        return new self($request->id,
        $request->nome,
        $request->cpf,
        $request->idade,
        $request->status,
        $request->booking_id
        );
    }
}