<?php

namespace App\Http\Controllers;

use App\DTO\SatisfactionSurveys\CreateSatisfactionQuestionDTO;
use App\Http\Requests\SatisfactionSurveys\SatisfactionQuestionUpdateRequest;
use App\Services\SatisfactionSurveyService;
use Illuminate\Http\Request;

class SatisfactionSurveyController extends Controller
{
    public function __construct(
        protected SatisfactionSurveyService $service
        ){}
    public function index(Request $request)
    {
        $questions = $this->service->paginate_questions(page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), filter: $request->filter);;

        return view('satisfaction_survey.index', compact('questions'));
    }
    public function create_question()
    {
        return view('satisfaction_survey.create_question');
    }

    public function store_question(SatisfactionQuestionUpdateRequest $request)
    {
        $survey = $this->service->create_question(CreateSatisfactionQuestionDTO::makeFromRequest($request));

        return redirect()->route('survey.show', $survey->id);
    }
    public function change_question_status(Request $request)
    {
        $this->service->change_question_status($request->id);

        return redirect()->route('survey.index');
    }

    public function find_question(Request $request)
    {
        if(!$question = $this->service->find_question_and_answers(id: $request->id, page: $request->get('page', 1), totalPerPage: $request->get('per_page', 5), filter: $request->filter)){
            return back();
        }
        return view('satisfaction_survey.show', compact('question'));
    }
}
