<?php

namespace App\Filters;

use App\Filters\QueryFilter;
use Illuminate\Support\Carbon;

class BaseFilter extends QueryFilter
{
    public function filterStatus($value)
    {
        if ($value === 'active') {
            $this->builder->where('active', true);
        } elseif ($value === 'inactive') {
            $this->builder->where('active', false);
        }
    }

    public function filterKey($value)
    {
        $this->builder->where('name', 'like', '%' . $value . '%');
    }

    public function filterStartDate($value)
    {
        if ($value) {
            $date = Carbon::createFromFormat('d/m/Y', $value)->startOfDay();
            $this->builder->whereDate('created_at', '>=', $date);
        }
    }

    public function filterEndDate($value)
    {
        if ($value) {
            $date = Carbon::createFromFormat('d/m/Y', $value)->endOfDay();
            $this->builder->where('created_at', '<=', $date);
        }
    }
}
