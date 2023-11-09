<?php

namespace App\Repositories\Contract;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\DTO\Packages\UpdatePackageImageDTO;
use stdClass;

interface PackageRepository {
    public function getAll(string $filter = null): array;
    public function findOneById(string $id): stdClass|null;
    public function findOneBySlug(string $slug): stdClass|null;
    public function findOne(...$filters): stdClass|null;
    public function delete(string $id): void;
    public function create(CreatePackageDTO $dto): stdClass;
    public function update(UpdatePackageDTO $dto): bool|null;
    public function updateImage(UpdatePackageImageDTO $dto): stdClass|null;
    public function getAllByStatus(bool $status = true): array;
    // add change status
}