<?php

namespace App\Http\Requests\Recommendations;

use Illuminate\Foundation\Http\FormRequest;

class RecommendationsUpdateRequest extends FormRequest
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
            'content'=>'max:255|required'
        ];
    }
}
