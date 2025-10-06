<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class UserFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
