<?php

namespace App\DTO\Packages;

use App\Http\Requests\Packages\PackagesUpdateRequest;

class UpdatePackageDTO {
    public function __construct(
        public string $id,
        public string $name_package,
        public string $slug,
        public string $food_description,
        public string $beverages_description,
        public string $status,
        public float $price
    ) {}

    public static function makeFromRequest(PackagesUpdateRequest $request):self {
        return new self(
        $request->id,
        $request->name_package,
        $request->slug,
        $request->food_description,
        $request->beverages_description,
        $request->images,
        $request->status ?? true,
        $request->price
    );
    }
}