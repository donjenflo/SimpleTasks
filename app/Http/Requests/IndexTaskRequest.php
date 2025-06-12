<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexTaskRequest extends FormRequest
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
            'title' => 'string',
            'description' => 'email',
            'status_id' => 'integer|exists:task_statuses,id',
            'date_from' => ['date_format:Y-m-d', 'nullable'],
            'date_to' => ['date_format:Y-m-d', 'nullable'],
            'employee_id' => 'integer|exists:users,id',
            'order_direction' => 'string|in:asc,desc',
            'order_by' => 'string|in:title,description,status_id,created_at,employee_id'
        ];
    }
}
