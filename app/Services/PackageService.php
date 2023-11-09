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

    private function get_by_slug($slug) {
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
        $slug = $this->format_slug($dto->slug);
        $slug_exists = $this->get_by_slug($dto->slug);
        if($slug_exists) throw new ValueError('Slug already exists');

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
    public function findBySlug($id) {
        return $this->package->findOneBySlug($id);
    }

    public function delete(string $slug) {
        return $this->package->delete($slug);
    }

    public function update(UpdatePackageDTO $dto) {
        $package_exists = $this->get_by_slug($dto->slug);

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