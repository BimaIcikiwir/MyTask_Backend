<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'nullable|exists:categories,id',
            'period_id' => 'nullable|exists:periods,id',
            'user_id' => 'nullable|exists:users,id',
            'name' => 'nullable|string',
            'level_of_urgency' => 'nullable|in:low,medium,high,critical',
            'due_date' => 'nullable|date',
            'is_completed' => 'nullable|boolean',
        ];
    }
}
