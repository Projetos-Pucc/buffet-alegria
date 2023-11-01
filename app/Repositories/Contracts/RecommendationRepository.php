<?php

namespace App\Repositories\Contract;

use App\DTO\Recommendation\CreateRecommendationDTO;
use App\DTO\Recommendation\UpdateRecommendationDTO;
use stdClass;

interface RecommendationRepository {
    public function getAll(string $filter = null): array;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function create(CreateRecommendationDTO $dto): stdClass;
    public function update(UpdateRecommendationDTO $dto): bool|null;
    public function delete(string $id): void;

}