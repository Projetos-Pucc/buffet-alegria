<?php

namespace App\Repositories\Contract;

use App\DTO\Guests\GuestDTO;
use App\DTO\Guests\UpdateGuestDTO;
use stdClass;

interface GuestRepository {
    public function getAll(string $filter = null): array;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function delete(string $id): void;
    public function create(GuestDTO $dto): stdClass;
}