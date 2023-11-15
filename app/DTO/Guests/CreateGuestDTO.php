<?php

namespace App\DTO\Guests;

use App\Enums\GuestStatus;
use App\Http\Requests\Guests\GuestsUpdateRequest;

class CreateGuestDTO {
    /**
     * @property array[] $rows
     * @property string $rows[].nome
     * @property string $rows[].cpf
     * @property string $rows[].idade
     * @property string $rows[].status
     */
    public function __construct(
        public array $rows,
        public int $booking_id
    ) {}

    public static function makeFromRequest(GuestsUpdateRequest $request):self {
        return new self(
            $request->rows,
            $request->booking_id
        );
    }
}