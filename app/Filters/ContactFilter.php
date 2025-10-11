<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class ContactFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
