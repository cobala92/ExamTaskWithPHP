<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'status' => 'required',
            'status.*' => Rule::in([0, 1]),
            'assignee' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A Title is required',
            'description.required' => 'A Description is required',
            'status.required' => 'A Status is required',
            'assignee.required' => 'A Assignee is required',
        ];
    }
}
