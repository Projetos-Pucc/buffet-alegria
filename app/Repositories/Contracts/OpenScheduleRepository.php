<?php

namespace App\Repositories\Contract;

use App\DTO\OpenSchedules\CreateOpenScheduleDTO;
use App\DTO\OpenSchedules\UpdateOpenScheduleDTO;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

interface OpenScheduleRepository {
    public function getOpenSchedulesByDay(DateTime $day): array;
    public function getOpenSchedulesByDayUpdate(DateTime $day, int $booking_id): array;
    public function getClosedSchedulesByDay(DateTime $day): array;
    public function findByHour(int $hour): stdClass|null;
    public function findByDayAndHour(DateTime $day, string $hour): stdClass|null;

    public function getAll(string $filter = null): array;
    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function delete(string $id): bool|null;
    public function create(CreateOpenScheduleDTO $dto): stdClass;
    public function update(UpdateOpenScheduleDTO $dto): bool|null;
}