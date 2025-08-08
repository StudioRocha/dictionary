<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DictionaryStoreRequest extends FormRequest
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
            'description.required' => '説明は必須です。',
            'keyword.max'      => 'キーワードは255文字以内で入力してください。',
            'body.required'    => '説明は必須です。',
            'body.max'         => '説明は5000文字以内で入力してください。',
        ];
    }
}
