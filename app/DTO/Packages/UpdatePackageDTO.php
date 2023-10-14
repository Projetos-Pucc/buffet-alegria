<?php

namespace App\DTO\Packages;

class UpdatePackageDTO {
    public function __construct(
        public string $id,
        public string $name_package,
        public string $slug,
        public string $food_description,
        public string $beverages_description,
        public string $photo_1,
        public string $photo_2,
        public string $photo_3,
    ) {}
}