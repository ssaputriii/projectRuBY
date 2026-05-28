<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SafeTextRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', 'regex:/^[\pL\pM\s.\'-]+$/u'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'message' => ['required', 'string', 'max:1000', 'not_regex:/<[^>]*>/'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'email' => strtolower(trim((string) $this->input('email'))),
            'message' => trim((string) $this->input('message')),
        ]);
    }
}
