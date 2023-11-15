<?php

namespace App\Http\Requests\Guests;

use Illuminate\Foundation\Http\FormRequest;

class GuestsUpdateRequest extends FormRequest
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
        $rules = [   
            'rows' => 'required|array',
            'rows.*.nome' => 'required|string|max:255',
            'rows.*.cpf' => 'required|string',
            'rows.*.idade' => 'required|string',
            'booking_id' => 'required'
         ];
        return $rules;
    }
}
