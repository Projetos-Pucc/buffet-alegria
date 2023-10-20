<?php

namespace App\Repositories\Eloquent;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\DTO\Packages\UpdatePackageImageDTO;
use App\Models\Package;
use App\Repositories\Contract\PackageRepository;
use stdClass;

class EloquentORMPackageRepository implements PackageRepository {
    public function __construct(
        protected Package $package
    ){}

    public function getAll(string $filter = null): array {
        return $this->package->get()->toArray();
    }

    public function findOneById(string $id): stdClass|null {
        $package = $this->package->find($id);
        if (!$package) {
            return null;
        }
        return (object) $package->toArray();
    }

    public function delete(string $id): void {
        //validate if package exists
        $this->package->delete($id);
    }

    public function create(CreatePackageDTO $dto): stdClass {
        $package = $this->package->create((array)$dto);
        return (object)$package->toArray();
    }
    
    public function update(UpdatePackageDTO $dto): stdClass|null {
        if(!$package = $this->package->find($dto->id)){
            return null;
        }
        return $package->update((array)$dto);
    }

    public function updateImage(UpdatePackageImageDTO $dto): stdClass|null {
        if(!$package = $this->package->find($dto->id)){
            return null;
        }
        return $package->update((array)$dto);
    }

    public function findOne(...$filters): stdClass|null {
        $package = $this->package->get()->where(...$filters)->first();
        if (!$package) {
            return null;
        }
        return (object) $package->toArray();
    }
}