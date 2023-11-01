<?php

namespace App\Repositories\Eloquent;

use App\DTO\Recommendation\CreateRecommendationDTO;
use App\DTO\Recommendation\UpdateRecommendationDTO;
use App\Models\Recommendation;
use App\Repositories\Contract\RecommendationRepository;
use stdClass;

class EloquentORMRecommendationRepository implements RecommendationRepository {
    public function __construct(
        protected Recommendation $recommendation
    ){}

    public function getAll(?string $filter = null): array
    {
        return $this->recommendation
            ->where(function ($query) use ($filter){
                if($filter){
                    $query->where('content', 'like', "%{$filter}%");
                }
            })
            ->get()->toArray();
    }

    public function findOneById(string $id): ?stdClass
    {
        $recommendation = $this->recommendation->find($id);
        if(!$recommendation){
            return null;
        }
        return (object) $recommendation->toArray();
    }

    public function findOne(...$filters): ?stdClass
    {
        $recommendation = $this->recommendation->get()->where(...$filters)->first();
        if(!$recommendation){
            return null;
        }
        return (object) $recommendation->toArray();
    }

    public function create(CreateRecommendationDTO $dto): stdClass
    {
        $recommendation = $this->recommendation->create((array)$dto);
        return (object)$recommendation->toArray();
        
    }

    public function update(UpdateRecommendationDTO $dto): ?bool
    {
        if(!$recommendation = $this->recommendation->find($dto->id )){
            return null;
        }
        return $recommendation->update((array)$dto);
    }

    public function delete(string $id): void
    {
        $this->recommendation->delete($id);
        
    }
}