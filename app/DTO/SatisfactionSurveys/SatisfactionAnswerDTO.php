<?php

namespace App\DTO\SatisfactionSurveys;

use App\Enums\QuestionType;
use App\Http\Requests\SatisfactionSurveys\SatisfactionQuestionUpdateRequest;

class SatisfactionAnswerDTO {
    public function __construct(
        public int $booking_id,
        public int $question_id,
        public string $answer,
    ) {}

    public static function makeFromRequest(SatisfactionQuestionUpdateRequest $request):self {
        return new self(
            $request->booking_id,
            $request->question_id,
            $request->answer
        );
    }
}