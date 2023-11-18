<?php

namespace App\Repositories\Eloquent;

use App\DTO\SatisfactionSurveys\CreateSatisfactionQuestionDTO;
use App\Models\SatisfactionAnswer;
use App\Models\SatisfactionQuestion;
use App\Repositories\Contract\SatisfactionSurveyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class EloquentORMSatisfactionSurveyRepository implements SatisfactionSurveyRepository
{
    public function __construct(
        protected SatisfactionQuestion $questions,
        protected SatisfactionAnswer $answers
    ) {}

    public function paginate_questions(int $page = 1, int $totalPerPage = 15, string $filter = null): LengthAwarePaginator
    {
        return $this->questions
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('question', 'like', "%{$filter}%");
                }
            })->paginate($totalPerPage, ['*'], 'page', $page);
    }

    public function create_question(CreateSatisfactionQuestionDTO $dto): stdClass{
        $questions = $this->questions->create((array)$dto);
        return (object)$questions->toArray();
    }
    public function find_question_by_id(int $id): stdClass|null{
        $question = $this->questions->find($id);
        if (!$question) {
            return null;
        }
        return (object) $question->toArray();
    }
    public function paginate_answers_by_question_id(int $id, int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator {
        return $this->answers->where('question_id', $id)->with('bookings')->paginate($totalPerPage, ['*'], 'page', $page);
    }
    public function change_status(int $id): ?bool
    {
        if (!$question = $this->find_question_by_id($id)) {
            return null;
        }
        return $this->questions->where('id', $id)->update(['status'=>!$question->status]);
    }
}
