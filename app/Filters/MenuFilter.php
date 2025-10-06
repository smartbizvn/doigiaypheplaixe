<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class MenuFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
