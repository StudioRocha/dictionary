<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * アプリ内の「辞書項目」を表すモデル。
 *
 * 主なカラム:
 * - user_id: 投稿者ユーザーID（本人のみ編集・削除可）
 * - keyword: キーワード（最大10文字）
 * - description: 説明（最大50文字）
 */
class Dictionary extends Model
{
    use HasFactory;

    /**
     * 一括代入を許可する属性。
     * バリデーションは FormRequest（Store/Update）で実施。
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'keyword', 'description'];

    /**
     * 投稿者ユーザーとのリレーション。
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}