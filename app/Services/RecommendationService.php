<?php

namespace App\Services;

use App\DTO\Recommendation\CreateRecommendationDTO;
use App\DTO\Recommendation\UpdateRecommendationDTO;
use App\Repositories\Contract\RecommendationRepository;
use ValueError;

class RecommendationService {
    public function __construct(
        protected RecommendationRepository $recommendation

    )
    {}

    private function validate_recommendation($content)
    {
        $recommendation_exists = false;
        
        if($this->recommendation->findOne('content',$content)){
            $recommendation_exists = true;
        }
        return $recommendation_exists;
    }

    public function getAll(): array
    {

        return $this->recommendation->getAll();
    }

    public function find($id)
    {

        return $this->recommendation->findOneById($id);        
    }
    public function create(CreateRecommendationDTO $dto)
    {
        $recomm_exists = $this->validate_recommendation($dto->content);
        if($recomm_exists){
            throw new ValueError('Content already exists');
        }

        return $this->recommendation->create($dto);
    }

    public function delete($id)
    {
        return $this->recommendation->delete($id);
    }

    public function update(UpdateRecommendationDTO $dto)
    {
        
        return $this->recommendation->update($dto);
    }
}