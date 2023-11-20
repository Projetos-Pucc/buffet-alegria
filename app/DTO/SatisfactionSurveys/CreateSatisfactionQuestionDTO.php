<?php

namespace App\DTO\SatisfactionSurveys;

use App\Enums\QuestionType;
use App\Http\Requests\SatisfactionSurveys\SatisfactionQuestionUpdateRequest;

class CreateSatisfactionQuestionDTO {
    public function __construct(
        public string $question,
        public bool $status,
        public string $question_type,
    ) {}

    public static function makeFromRequest(SatisfactionQuestionUpdateRequest $request):self {
        return new self(
            $request->question,
            $request->status ?? true,
            $request->question_type ?? QuestionType::D->name
        );
    }
}