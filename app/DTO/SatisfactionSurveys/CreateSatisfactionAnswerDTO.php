<?php

namespace App\DTO\SatisfactionSurveys;

use App\Enums\QuestionType;
use App\Http\Requests\SatisfactionSurveys\SatisfactionAnswerUpdateRequest;
use App\Http\Requests\SatisfactionSurveys\SatisfactionQuestionUpdateRequest;

class CreateSatisfactionAnswerDTO {
    /**
     * @property array[] $rows
     * @property string $rows[].question_id
     * @property string $rows[].booking_id
     * @property string $rows[].answer
     * @property string $rows[].status
     */
    public function __construct(
        public array $rows,
        public int $booking_id
    ) {}

    public static function makeFromRequest(SatisfactionAnswerUpdateRequest $request):self {
        return new self(
            $request->rows,
            $request->booking_id
        );
    }
}