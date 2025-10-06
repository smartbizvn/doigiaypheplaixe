<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class ArticleCategoryFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
