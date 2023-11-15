<?php

namespace App\DTO\Guests;

class GuestDTO {
    public function __construct(
        public string $nome,
        public string $cpf,
        public int $idade,
        public string $status,
        public int $booking_id
    ) {}
}