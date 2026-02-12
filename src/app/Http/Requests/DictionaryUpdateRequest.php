<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DictionaryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認可はPolicyで別途制御
    }

    public function rules(): array
    {
        return [
            'keyword'     => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'keyword.required' => 'キーワードは必須です。',
            'keyword.max'      => 'キーワードは10文字以内で入力してください。',
            'description.required' => '説明は必須です。',
            'description.max'  => '説明は50文字以内で入力してください。',
        ];
    }
}
