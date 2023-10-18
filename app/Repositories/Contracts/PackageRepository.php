<?php

namespace App\Repositories\Contract;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use stdClass;

interface PackageRepository {
    public function getAll(string $filter = null): array;
    public function findOneById(string $id): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function delete(string $id): void;
    public function create(CreatePackageDTO $dto): stdClass;
    public function update(UpdatePackageDTO $dto): stdClass|null;
}