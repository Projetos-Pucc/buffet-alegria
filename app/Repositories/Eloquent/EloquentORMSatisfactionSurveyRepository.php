<?php

namespace App\Repositories\Eloquent;

use App\DTO\SatisfactionSurveys\CreateSatisfactionQuestionDTO;
use App\DTO\SatisfactionSurveys\SatisfactionAnswerDTO;
use App\DTO\SatisfactionSurveys\UpdateSatisfactionQuestionDTO;
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
    public function update_answers_count(int $id): bool|null{
        if (!$question = $this->find_question_by_id($id)) {
            return null;
        }
        return $this->questions->where('id', $id)->update(['answers'=>$question->answers+1]);
    }
    public function submit_answer(SatisfactionAnswerDTO $dto): stdClass{
        $survey = $this->answers->create((array)$dto);
        return (object)$survey->toArray();
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
    public function get_questions_in_random_order(int $qtd_questions=10): array {
        return $this->questions->inRandomOrder()->where('status', true)->get()->take(10)->toArray();
    }
    public function update_question(UpdateSatisfactionQuestionDTO $dto): bool|null{
        if (!$question = $this->questions->find($dto->id)) {
            return null;
        }
        return $question->update((array)$dto);
    }
}
