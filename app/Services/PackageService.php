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
    
    public function create(CreatePackageDTO $dto) {
        return $this->package->create($dto);
    }

    public function getAll(): array {
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