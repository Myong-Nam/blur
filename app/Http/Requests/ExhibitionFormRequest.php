<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionFormRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|after_or_equal:start_date',
            'tags' => 'required',
            'type_id' => 'required|integer',
            'museum' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required',
            'description.required' => 'The description field is required',
            'location.required' => 'The location field is required',
            'start_date.required' => 'The start date field is required',
            'end_date.after_or_equal:start_date' => 'The end date must not be earlier than the start date.',
            'tags.required' => 'The tags field is required',
            'type_id.integer' => 'The category field is required.',
            'museum' => 'The museum field is required.',
        ];
    }
}
