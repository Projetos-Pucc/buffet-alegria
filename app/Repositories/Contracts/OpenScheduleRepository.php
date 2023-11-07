<?php

namespace App\Repositories\Contract;

use DateTime;
use stdClass;

interface OpenScheduleRepository {
    public function getOpenSchedulesByDay(DateTime $day): array;
    public function getClosedSchedulesByDay(DateTime $day): array;
    public function findByHour(string $hour): stdClass;
    public function findByDayAndHour(DateTime $day, string $hour): stdClass|null;
}