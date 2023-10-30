<?php

namespace App\DTO\Recommendation;

use App\Http\Requests\Recomendations\RecommendationsUpdateRequest;

class UpdateRecommendationDTO {
    public function __construct(
        public string $id,
        public string $content
    ) {}

    public static function makeFromRequest(RecommendationsUpdateRequest $request):self {
        return new self(
            $request->id,
            $request->content

        );
    }
}