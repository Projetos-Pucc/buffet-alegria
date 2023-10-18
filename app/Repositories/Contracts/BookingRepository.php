<?php

namespace App\Repositories\Contract;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use stdClass;

interface BookingRepository {
    public function getAll(string $filter = null): array;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function delete(string $id): void;
    public function create(CreateBookingDTO $dto): stdClass;
    public function update(UpdateBookingDTO $dto): stdClass|null;
}