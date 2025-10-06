<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class BannerFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
