<?php

namespace App\Services;

use App\Repositories\Contract\RecommendationRepository;

class RecommendationService {
    public function __construct(
        protected RecommendationRepository $recommendation

    )
    {}
    
}