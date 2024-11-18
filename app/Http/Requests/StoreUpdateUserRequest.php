<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'unique:tb_user',
                    'max:255',
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:255',
                ]
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:tb_user,email,' . $this->route('user') . ',id',
                ],
                'password' => [
                    'nullable',
                    'string',
                    'min:8',
                    'max:255',
                ]
            ];
        }
        return $rules;
    }

    // Custom validation messages
    public function messages(): array
    {
        return [
            // 'name.required' => 'Name required',
        ];
    }
}
