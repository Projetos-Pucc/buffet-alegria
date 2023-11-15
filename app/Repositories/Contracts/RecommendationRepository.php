<?php

namespace App\Repositories\Contract;

use App\DTO\Recommendation\CreateRecommendationDTO;
use App\DTO\Recommendation\UpdateRecommendationDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

interface RecommendationRepository {
    public function getAll(string $filter = null): array;
    public function paginate(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function create(CreateRecommendationDTO $dto): stdClass;
    public function update(UpdateRecommendationDTO $dto): bool|null;
    public function delete(string $id): bool|null;

}