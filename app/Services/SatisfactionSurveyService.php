<?php

namespace App\Services;

use App\DTO\SatisfactionSurveys\CreateSatisfactionAnswerDTO;
use App\DTO\SatisfactionSurveys\CreateSatisfactionQuestionDTO;
use App\DTO\SatisfactionSurveys\SatisfactionAnswerDTO;
use App\DTO\SatisfactionSurveys\UpdateSatisfactionQuestionDTO;
use App\Enums\BookingStatus;
use App\Repositories\Contract\BookingRepository;
use App\Repositories\Contract\SatisfactionSurveyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use ValueError;

class SatisfactionSurveyService {
    public function __construct(
        protected SatisfactionSurveyRepository $survey,
        protected BookingRepository $booking,

    )
    {}

    public function paginate_questions(
        int $page=1,
        int $totalPerPage=15,
        string $filter = null
    ): LengthAwarePaginator
    {
        return $this->survey->paginate_questions(page: $page, totalPerPage: $totalPerPage, filter: $filter);
    }

    public function create_question(CreateSatisfactionQuestionDTO $dto)
    {
        return $this->survey->create_question($dto);
    }
    public function submit_answer(SatisfactionAnswerDTO $dto)
    {
        return $this->survey->submit_answer($dto);
    }
    public function submit_answers(CreateSatisfactionAnswerDTO $dto)
    {
        $rows = [];
        foreach ($dto->rows as $question=>$answer) {
            $data = [
                "booking_id" => $dto->booking_id,
                "question_id" => explode('q-',$question)[1],
                "answer" => $answer,
            ];
            $this->survey->update_answers_count($data['question_id']);
            array_push($rows, $this->submit_answer(new SatisfactionAnswerDTO(...$data)));
        }
        $this->booking->changeStatus($dto->booking_id, BookingStatus::F);
        $response = [
            'booking_id'=>$dto->booking_id,
            'rows'=>$rows
        ];

        return $response;
    }

    public function find_question_by_id(int $id) {
        return $this->survey->find_question_by_id($id);
    }

    public function change_question_status($id)
    {
        return $this->survey->change_status($id);
    }

    public function find_question_and_answers(
        int $page=1,
        int $totalPerPage=15,
        string $filter = null,
        int $id
    ) {
        $questions = $this->survey->find_question_by_id(id: $id);  
        $answers = $this->survey->paginate_answers_by_question_id(page: $page, totalPerPage: $totalPerPage, filter: $filter, id: $id);  
        return ['questions'=>$questions, 'answers'=>$answers];      
    }

    public function get_questions_in_random_order(int $qtd_questions) {
        return $this->survey->get_questions_in_random_order($qtd_questions);
    }

    public function update(UpdateSatisfactionQuestionDTO $dto)
    {
        return $this->survey->update_question($dto);
    }

}