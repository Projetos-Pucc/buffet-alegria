<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recomendations\RecommendationUpdateRequest;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function __construct(
        protected RecommendationService $service
        ){}
    
    public function index()
    {
        $recommendations = [
            [
                'id'=>1,
                'content'=>'teste'
            ],
            [
                'id'=>2,
                'content'=>'teste2'
            ]
        ];

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

    public function store(RecommendationUpdateRequest $request)
    {
        return redirect()->route('recommendations.index');
    }
    public function delete(Request $request)
    {

        return redirect()->route('recommendations.index');
    }
    public function edit(Request $request)
    {

        return view('recommendations.update');
    }

    public function update(RecommendationUpdateRequest $request)
    {
        
        return redirect()->route('recommendations.index');
    }
}