<?php

namespace App\Repositories\Contract;

use App\DTO\SatisfactionSurveys\CreateSatisfactionQuestionDTO;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

interface SatisfactionSurveyRepository {
    public function paginate_questions(int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function create_question(CreateSatisfactionQuestionDTO $dto): stdClass;
    public function change_status(int $id): bool|null;
    public function paginate_answers_by_question_id(int $id, int $page=1, int $totalPerPage=15, string $filter = null): LengthAwarePaginator;
    public function find_question_by_id(int $id): stdClass|null;
}