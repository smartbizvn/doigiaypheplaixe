<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class ArticleFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
