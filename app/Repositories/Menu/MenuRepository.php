<?php

namespace App\Repositories\Menu;

use App\Repositories\BaseRepository;
use App\Repositories\Menu\MenuRepositoryInterface as EntityRepositoryInterface;
use App\Models\Menu as Entity;
use App\Filters\MenuFilter as EntityFilter;

class MenuRepository extends BaseRepository implements EntityRepositoryInterface
{
    public function __construct(Entity $entity)
    {
        parent::__construct($entity);
    }

    public function list($request)
    {
        $query = $this->query();
        $params = $request->query();

        $summaryParams = collect($params)->except('status')->toArray();
        $summaryQuery = $this->filter(clone $query, $summaryParams, EntityFilter::class);

        $summary = [
            'total' => (clone $summaryQuery)->count(),
            'active' => (clone $summaryQuery)->where('active', true)->count(),
            'inactive' => (clone $summaryQuery)->where('active', false)->count()
        ];

        $filterQuery = $this->filter($query, $params, EntityFilter::class);
        $paginate = $this->paginate($filterQuery);

        return [$paginate, $summary];
    }

    public function parentMenu()
    {
        return $this->model->whereNull('parent_id')->with('children_menus')->get();
    }
}
