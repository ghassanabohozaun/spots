<?php

namespace App\Http\Requests\Dashboard;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name.*' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email','string', 'max:120', Rule::unique('users', 'email')->ignore($this->id)],
            'mobile' => ['required', 'string'],
            'password' => ['required', 'min:6'],
            'password_confirm' => ['required', 'same:password'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
