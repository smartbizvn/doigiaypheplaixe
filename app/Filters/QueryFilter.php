<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QueryFilter
{
    protected Request $request;
    protected Builder $builder;
    protected array $filters = [];

    /**
     * Các field cho phép lọc tự động
     * Ví dụ: ['email', 'status' => 'is_active']
     */
    protected array $filterable = [];

    /**
     * Field mặc định để sắp xếp
     */
    protected ?string $orderField = 'id';

    /**
     * Kiểu sắp xếp mặc định
     */
    protected string $orderType = 'desc';

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->filters = $request->all();
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        $this->applyFilters();
        $this->applyOrder();

        return $this->builder;
    }

    protected function applyFilters(): void
    {
        foreach ($this->filters as $name => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $method = 'filter' . Str::studly($name);

            // Nếu có hàm filterXxx thì gọi
            if (method_exists($this, $method)) {
                $this->{$method}($value);
                continue;
            }

            // Nếu có trong filterable (dạng key => field hoặc value là field)
            if (!empty($this->filterable)) {
                if (array_key_exists($name, $this->filterable)) {
                    $field = $this->filterable[$name];
                    $this->builder->where($field, $value);
                    continue;
                }

                if (in_array($name, $this->filterable)) {
                    $this->builder->where($name, $value);
                    continue;
                }
            }
        }
    }

    protected function applyOrder(): void
    {
        $orderField = $this->request->input('order_by', $this->orderField);
        $orderType = $this->request->input('order_type', $this->orderType);

        if ($orderField) {
            $this->builder->orderBy($orderField, $orderType);
        }
    }
}
