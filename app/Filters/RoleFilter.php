<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class RoleFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
