<?php

namespace App\Services;

use App\DTO\Packages\CreatePackageDTO;
use App\DTO\Packages\UpdatePackageDTO;
use App\DTO\Packages\UpdatePackageImageDTO;
use App\Repositories\Contract\PackageRepository;
use ValueError;

class PackageService {

    public static string $image_repository = 'app/public/packages';

    public function __construct(
        protected PackageRepository $package

    ){}

    private function format_slug(string $slug) {
        return str_replace(' ', '-', $slug);

    }

    private function validate_slug_exists($slug) {
        $slug = $this->format_slug($slug);
        $slug_exists = $this->package->findOne('slug', $slug);
        return $slug_exists;
    }

    private function uploadImage($image) {
        $imageName = time() . rand(1, 99) . '.' . $image->extension();
        $image->move(storage_path(self::$image_repository), $imageName);

        return $imageName;
    }
    
    public function create(CreatePackageDTO $dto) {
        // slug can't has spaces
        $slug = $this->validate_slug_exists($dto->slug);

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

    public function getAllByStatus(bool $status = true):array {
        return $this->package->getAll($status);
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
        $package_exists = $this->validate_slug_exists($dto->slug);

        if($package_exists && $package_exists->id != $dto->id) throw new ValueError('Slug already exists');

        $dto->slug = $this->format_slug($dto->slug);

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