<?php

namespace App\Repositories\Contract;

use stdClass;

interface RecommendationRepository {
    public function getaAll(string $filter = null): array;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function create();
    public function delete(string $id): void;
    public function update();

}