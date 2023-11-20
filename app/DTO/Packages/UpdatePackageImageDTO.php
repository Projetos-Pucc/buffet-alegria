<?php

namespace App\DTO\Packages;

use App\Http\Requests\Packages\PackagesUpdateRequest;
use Illuminate\Http\Request;

class UpdatePackageImageDTO {
    public function __construct(
        public string $slug,
        public mixed $photo,
        public int $image_id
    ) {}

    public static function makeFromRequest(Request $request):self {
        return new self(
            $request->slug,
            $request->photo,
            $request->image_id,
        );
    }
}