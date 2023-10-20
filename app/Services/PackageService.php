<?php

namespace App\Services;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\DTO\Packages\UpdatePackageImageDTO;
use App\Repositories\Contract\PackageRepository;
use ValueError;

class PackageService {

    public function __construct(
        protected PackageRepository $package

    ){}

    private function validateSlug($slug) {
        $slug = str_replace(' ', '-', $slug);

        $slug_exists = $this->package->findOne('slug', $slug);
        if($slug_exists) return false;
        return $slug;
    }

    private function uploadImage($image) {
        $imageName = time() . rand(1, 99) . '.' . $image->extension();
        $image->move(storage_path('images'), $imageName);

        return $imageName;
    }
    
    public function create(CreatePackageDTO $dto) {
        // slug can't has spaces
        $slug = $this->validateSlug($dto->slug);

        if(!$slug) throw new ValueError('Slug already exists');

        $dto->slug = $slug;

        if (isset($dto->images)) {
            if (count($dto->images) !== 3) {
                throw new ValueError('Has less than 3 images');
            }
            $image_index = 1;
            foreach ($dto->images as $image) {
                $img_db = 'photo_' . $image_index;
                $image_index++;
                $dto->$img_db = $this->uploadImage($image);
            }
            unset($dto->images);
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
        $slug = $this->validateSlug($dto->slug);

        if(!$slug) throw new ValueError('Slug already exists');

        $dto->slug = $slug;

        return $this->package->update($dto);
    }

    public function updateImage(UpdatePackageImageDTO $dto) {
        $imageName = $this->uploadImage($dto->photo);

        $photo = $dto->photo . $dto->image_id;

        $dto->photo = $imageName;

        unset($dto->photo);
        unset($dto->image_id);

        return $this->package->updateImage($dto);
    }
    
}