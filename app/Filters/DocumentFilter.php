<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class DocumentFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
