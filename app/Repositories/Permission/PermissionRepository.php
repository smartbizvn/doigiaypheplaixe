<?php

namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use App\Repositories\Permission\PermissionRepositoryInterface as EntityRepositoryInterface;
use App\Models\Permission as Entity;
use App\Filters\PermissionFilter as EntityFilter;
use App\Helpers\Helper;

class PermissionRepository extends BaseRepository implements EntityRepositoryInterface
{
    public function __construct(Entity $entity)
    {
        parent::__construct($entity);
    }

    # Auto update or insert permission
    function initPermissions(){
        $userLogin = auth()->user();
        $modules  = Helper::getModules();
        foreach ($modules as $moduleId => $module) {
            $actions = $module['actions'];
            foreach ($actions as $action) {
                $this->model->updateOrCreate(
                    ['slug' => $moduleId.'_'.$action['slug']], 
                    [
                        'name'       => $action['name']." ".$module['name'],
                        'slug'       => $moduleId.'_'.$action['slug'],
                        'desc'       => $action['name']." ".$module['name'],
                        'active'     => true,
                        'created_by' => $userLogin->id
                    ]
                );
            }
        }
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
}
