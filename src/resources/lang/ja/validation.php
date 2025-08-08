<?php

return [
    'required' => ':attribute は必須です。',
    'email' => ':attribute は有効なメールアドレス形式で指定してください。',
    'confirmed' => ':attribute が確認用と一致しません。',
    'unique' => ':attribute は既に使用されています。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attribute は :max 文字以下で入力してください。',
    ],

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認）',
    ],
];
