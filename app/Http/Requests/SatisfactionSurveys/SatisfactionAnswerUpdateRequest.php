<?php

namespace App\Http\Requests\SatisfactionSurveys;

use Illuminate\Foundation\Http\FormRequest;

class SatisfactionAnswerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'rows' => 'required|array',
            // 'rows.question_id' => 'required|int',
            // 'rows.booking_id' => 'required|int',
            // 'rows.answer' => 'required',
        ];
    }
}
