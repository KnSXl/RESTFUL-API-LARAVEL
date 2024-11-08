<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUsuarioRequest extends FormRequest
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
                'ds_name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'ds_email' => [
                    'required',
                    'string',
                    'email',
                    'unique:tb_user',
                    'max:255',
                ],
                'ds_password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:255',
                ]
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            $rules = [
                'ds_name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'ds_email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:tb_user,ds_email,' . $this->route('user') . ',cd_user',
                ],
                'ds_password' => [
                    'nullable',
                    'string',
                    'min:8',
                    'max:255',
                ]
            ];
        }
        return $rules;
    }
}
