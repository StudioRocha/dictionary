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
            'keyword'     => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'keyword.required' => 'キーワードは必須です。',
            'keyword.max'      => 'キーワードは255文字以内で入力してください。',
            'description.required' => '説明は必須です。',
        ];
    }
}
