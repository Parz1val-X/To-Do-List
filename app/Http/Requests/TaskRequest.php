<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'completed' => ['sometimes', 'boolean'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['array'],
            'tags.*' => ['exists:tags,id'],
        ];
    }
}
