<?php

namespace App\Services;

use App\DTO\SatisfactionSurveys\CreateSatisfactionQuestionDTO;
use App\Repositories\Contract\SatisfactionSurveyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use ValueError;

class SatisfactionSurveyService {
    public function __construct(
        protected SatisfactionSurveyRepository $survey

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

}