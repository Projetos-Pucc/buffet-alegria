<?php

namespace App\Repositories\Eloquent;

use App\Models\Recommendation;
use App\Repositories\Contract\RecommendationRepository;
use stdClass;

class EloquentORMRecommendationRepository implements RecommendationRepository {
    public function __construct(
        protected Recommendation $recommendation
    ){}

}