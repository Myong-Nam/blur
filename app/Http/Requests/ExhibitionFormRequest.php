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
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|after_or_equal:start_date',
            'tags' => 'required',
            'type_id' => 'required|integer',
            'museum' => 'required',
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required',
            'title.max' => 'The title may not be greater than 255 characters',
            'description.required' => 'The description field is required',
            'description.min' => 'The description must be at least 10 characters',
            'location.required' => 'The location field is required',
            'start_date.required' => 'The start date field is required',
            'end_date.after_or_equal:start_date' => 'The end date must not be earlier than the start date',
            'tags.required' => 'The tags field is required',
            'type_id.required' => 'The category field is required',
            'type_id.integer' => 'The category must be an integer',
            'museum.required' => 'The museum field is required',
        ];
    }
}
