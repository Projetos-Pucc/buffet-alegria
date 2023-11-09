<?php

namespace App\DTO\Recommendation;

use App\Http\Requests\Recommendations\RecommendationsUpdateRequest;

class CreateRecommendationDTO {
    public function __construct(public string $content) 
    {}

    public static function makeFromRequest(RecommendationsUpdateRequest $request):self {
        return new self($request->content);
    }
}