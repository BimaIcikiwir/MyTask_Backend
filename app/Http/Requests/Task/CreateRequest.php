<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Jika yang login BUKAN admin (alias member), paksa user_id diisi ID dia sendiri
        if ($this->user() && $this->user()->role !== 'admin') {
            $this->merge([
                'user_id' => $this->user()->id,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'period_id' => 'required|exists:periods,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'level_of_urgency' => 'required|in:low,medium,high,critical',
            'due_date' => 'required|date',
            'is_completed' => 'required|boolean',
        ];
    }
}
