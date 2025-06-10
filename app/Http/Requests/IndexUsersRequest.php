<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexUsersRequest extends FormRequest
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
            'name' => 'string',
            'email' => 'email',
            'employee_status_id' => 'integer|exists:employee_statuses,id',
            'orderDirection' => 'string|in:asc,desc',
            'orderBy' => 'string|in:name,email,employee_status_id',
        ];
    }
}
