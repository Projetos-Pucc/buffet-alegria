<?php

namespace App\Http\Requests\Bookings;

use Illuminate\Foundation\Http\FormRequest;

class BookingsUpdateRequest extends FormRequest
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
            'name_birthdayperson' => 'required|max:255',
            'years_birthdayperson' => 'required|max:255',
            'qnt_invited' => 'required',
            'id_reservation' => 'required',
            'id_package' => 'required',
            'status' => 'required', // depois
            'package_id' => 'required',
            'price' => 'required'
        ];
        return $rules;
    }
}
