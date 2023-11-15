<?php

namespace App\Repositories\Contract;

use App\DTO\Bookings\CreateBookingDTO;
use App\DTO\Bookings\UpdateBookingDTO;
use App\Enums\BookingStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

interface BookingRepository {
    public function getAll(string $filter = null): array;
    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function paginate_next_bookings(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function findOneById(string $id): stdClass|null;
    public function findByUser(int $userId): array;
    public function findByUserPaginate(int $userId, int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function findOne(...$filters): stdClass|null;
    public function delete(string $id): bool|null;
    public function create(CreateBookingDTO $dto): stdClass;
    public function update(UpdateBookingDTO $dto): bool|null;
    public function changeStatus(string $id, BookingStatus $status):bool;
}