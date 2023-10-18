<?php

namespace App\Services;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\Repositories\Contract\PackageRepository;
use stdClass;

class PackageService {

    public function __construct(
        protected PackageRepository $package

    ){}
    
    // public function getAll(string $filter = null): array{
    //     return $this->repository->getAll();
    // }

    // public function findOne(string $id): stdClass|null{
    //     return $this->repository->findOne($id);

    // }

    public function create(CreatePackageDTO $dto) {
        return $this->package->create($dto);
    }

    public function getAll() {
        return $this->package->getAll();
    }

    public function find($id) {
        return $this->package->findOne($id);
    }

    public function delete($id) {
        $this->package->delete($id);
    }

    public function update(UpdatePackageDTO $dto) {
        //$this->package->
        
    }
    
}