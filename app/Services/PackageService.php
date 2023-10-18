<?php

namespace App\Services;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\Repositories\Contract\PackageRepository;
use stdClass;
use ValueError;

class PackageService {

    public function __construct(
        protected PackageRepository $package

    ){}
    
    public function create(CreatePackageDTO $dto) {
        // slug can't has spaces
        $dto->slug = explode(' ', $dto->slug);
        $dto->slug = implode('-', $dto->slug);

        $slug_exists = $this->package->findOne('slug', $dto->slug);
        if($slug_exists) {
            throw new ValueError('Slug already exists');
        }
        
        return $this->package->create($dto);
    }

    public function getAll(): array {
        return $this->package->getAll();
    }

    public function find($id) {
        return $this->package->findOneById($id);
    }

    public function delete($id) {
        $this->package->delete($id);
    }

    public function update(UpdatePackageDTO $dto) {
        //$this->package->
        
    }
    
}