<?php

namespace App\DTO\SatisfactionSurveys;

use App\Enums\QuestionType;
use App\Http\Requests\SatisfactionSurveys\SatisfactionQuestionUpdateRequest;

class UpdateSatisfactionQuestionDTO {
    public function __construct(
        public int $id,
        public string $question,
        public bool $status,
        public string $question_type,
    ) {}

    public static function makeFromRequest(SatisfactionQuestionUpdateRequest $request):self {
        return new self(
            $request->id,
            $request->question,
            $request->status ?? true,
            $request->question_type ?? QuestionType::D->name
        );
    }
}