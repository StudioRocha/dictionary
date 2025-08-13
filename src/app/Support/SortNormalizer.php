<?php

namespace App\Support;

final class SortNormalizer
{
    /**
     * 許容されるsort値以外は 'new' にフォールバック
     */
    public static function normalize(?string $sort): string
    {
        $allowed = ['new', 'old', 'keyword_asc', 'keyword_desc'];
        return in_array($sort, $allowed, true) ? $sort : 'new';
    }
}


