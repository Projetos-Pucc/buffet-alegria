<?php

namespace App\Repositories\Contract;

use App\DTO\Guests\GuestDTO;
use App\Enums\GuestStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

interface GuestRepository {
    public function getAll(string $filter = null): array;
    public function getByBookingPaginate(string $id, int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function getByBooking(string $id): array;
    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function delete(string $id): void;
    public function create(GuestDTO $dto): stdClass;
    public function updateStatus(string $id, string $status):bool|null;
}