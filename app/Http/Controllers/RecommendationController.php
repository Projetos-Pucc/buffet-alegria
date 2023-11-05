<?php

namespace App\Http\Controllers;

use App\DTO\Recommendation\CreateRecommendationDTO;
use App\DTO\Recommendation\UpdateRecommendationDTO;
use App\Http\Requests\Recomendations\RecommendationsUpdateRequest;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function __construct(
        protected RecommendationService $service
        ){}
    
    public function index()
    {
        $recommendations = $this->service->getAll();

        return view('recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        return view('recommendations.create');
    }

    public function find(string $id)
    {
        return view('recommendations.show');
    }

    public function store(RecommendationsUpdateRequest $request)
    {
        $this->service->create(CreateRecommendationDTO::makeFromRequest($request));

        return redirect()->route('recommendations.index');
    }

    public function delete(Request $request)
    {
        $this->service->delete($request->id);
        return redirect()->route('recommendations.index');
    }

    public function edit(Request $request)
    {   
        if(!$recommendations = $this->find($request->id)){
            return back();
        }
        
        return view('recommendations.update');
    }

    public function update(RecommendationsUpdateRequest $request)
    {
        $this->service->update(UpdateRecommendationDTO::makeFromRequest($request));
        return redirect()->route('recommendations.index');
    }
}