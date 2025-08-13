<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Support\SortNormalizer;

class SortNormalizerTest extends TestCase
{
    public function test_normalize_returns_allowed_values_or_new()
    {
        $this->assertSame('new', SortNormalizer::normalize('new'));
        $this->assertSame('old', SortNormalizer::normalize('old'));
        $this->assertSame('keyword_asc', SortNormalizer::normalize('keyword_asc'));
        $this->assertSame('keyword_desc', SortNormalizer::normalize('keyword_desc'));

        $this->assertSame('new', SortNormalizer::normalize(null));
        $this->assertSame('new', SortNormalizer::normalize('invalid'));
        $this->assertSame('new', SortNormalizer::normalize(''));    
    }
}


