<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest as EntityRequest;
use App\Repositories\Role\RoleRepositoryInterface as EntityRepositoryInterface;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Models\Role as Entity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Exception;

class RoleController extends BaseController
{
    public function __construct(EntityRepositoryInterface $entityRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->module = 'roles';
        $this->repository = $entityRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies($this->module . '_access'), 403);
        try {
            list($results, $summary) = $this->repository->list($request);
            $data =  [
                'results' => $results,
                'summary' => $summary,
                'module'  => $this->module,
            ];
            return view('backend.' . $this->module . '.index', $data);
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function create()
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        return view('backend.' . $this->module . '.create', $this->formData(new Entity()));
    }

    public function store(EntityRequest $request)
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        try {
            $role = $this->repository->create($this->getDataRequest($request));
            $role->permissions()->sync($request->input('permissions', []));
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function edit(Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        return view('backend.' . $this->module . '.edit', $this->formData($entity));
    }

    public function update(EntityRequest $request, Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        try {
            $this->repository->update($this->getDataRequest($request, $entity), $entity->id);
            $entity->permissions()->sync($request->input('permissions', []));
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function changeStatus(Request $request)
    {
        return parent::changeStatus($request);
    }

    public function delete(Request $request)
    {
        return parent::bulkDelete($request);
    }

    protected function getDataRequest($request, $entity = null)
    {
        $data = [
            'name'          => $request->name,
            'desc'          => $request->desc,
            'active'        => $request->active ?? false,
            'order'         => $request->order ?? 0
        ];
        return $data;
    }

    private function formData(Entity $entity)
    {
        $permissions = $this->permissionRepository->all();
        return [
            'result'          => $entity,
            'permissions'     => $permissions,
            'module'          => $this->module
        ];
    }
}