<?php

namespace App\Filters;
use App\Filters\BaseFilter;

class InfoDocumentFilter extends BaseFilter
{
    protected array $filterable = [
        'name',
        'active'
    ];
}
