<?php

namespace App\Http\Controllers;

use App\DTO\SatisfactionSurveys\CreateSatisfactionAnswerDTO;
use App\DTO\SatisfactionSurveys\CreateSatisfactionQuestionDTO;
use App\DTO\SatisfactionSurveys\UpdateSatisfactionQuestionDTO;
use App\Enums\BookingStatus;
use App\Http\Requests\SatisfactionSurveys\SatisfactionAnswerUpdateRequest;
use App\Http\Requests\SatisfactionSurveys\SatisfactionQuestionUpdateRequest;
use App\Services\BookingService;
use App\Services\SatisfactionSurveyService;
use Illuminate\Http\Request;

class SatisfactionSurveyController extends Controller
{
    public function __construct(
        protected BookingService $bookings,
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

    public function get_questions_by_user_id(Request $request) {
        $bookings = $this->bookings->getUserBookings($request->id);
        $booking_did_not_answered = null;
        if(!$bookings) return response()->json();
        foreach($bookings as $booking)
        {
            if($booking['status'] === BookingStatus::E->name){
                $booking_did_not_answered = $booking;
            }
        }
        if(!$booking_did_not_answered) return response()->json();
        $questions = $this->service->get_questions_in_random_order(10);

        return response()->json(['questions'=>$questions, 'data'=>['booking'=>$booking]]);
    }

    public function answer(SatisfactionAnswerUpdateRequest $request) {
       $this->service->submit_answers(CreateSatisfactionAnswerDTO::makeFromRequest($request));

        return redirect()->route('dashboard');
    }

    public function edit_question(Request $request) {
        if(!$question = $this->service->find_question_by_id($request->id)){
            return back();
        }

        return view('satisfaction_survey.update_question',compact('question'));
    }

    public function update_question(SatisfactionQuestionUpdateRequest $request){
        $question= $this->service->update(
            UpdateSatisfactionQuestionDTO::makeFromRequest($request)
        );
        if(!$question){
            return redirect()->route('survey.not_found');
        }

        return redirect()->route('survey.show_question', $request->id);
    }
}
