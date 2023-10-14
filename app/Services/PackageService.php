<?php

namespace App\Services;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\Repositories\Contract\PackageRepository;

class PackageService {

    public function __construct(
        protected PackageRepository $package
    ){}

    public function create(CreatePackageDTO $dto) {
        return $this->package->create($dto);
    }

    public function index() {
        return $this->package->getAll();
    }

    public function find($id) {
        return $this->find($id);
    }

    public function delete($id) {
        $this->package->delete($id);
    }

    public function update(UpdatePackageDTO $dto) {
        
    }
    
}