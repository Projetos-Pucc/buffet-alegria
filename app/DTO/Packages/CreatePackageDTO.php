<?php

namespace App\DTO\Packages;

use App\Http\Requests\Packages\PackagesUpdateRequest;

class CreatePackageDTO {
    public function __construct(
        public string $name_package,
        public string $slug,
        public string $food_description,
        public string $beverages_description,
        public string $photo_1,
        public string $photo_2,
        public string $photo_3,
    ) {}

    public static function makeFromRequest(PackagesUpdateRequest $request):self {
        return new self($request->name_package,
        $request->slug,
        $request->food_description,
        $request->beverages_description,
        $request->photo_1,
        $request->photo_2,
        $request->photo_3,
    );
    }
}