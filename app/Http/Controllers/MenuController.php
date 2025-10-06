<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest as EntityRequest;
use App\Repositories\Menu\MenuRepositoryInterface as EntityRepositoryInterface;
use App\Models\Menu as Entity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Exception;

class MenuController extends BaseController
{
    public function __construct(EntityRepositoryInterface $entityRepository)
    {
        $this->module = 'menus';
        $this->repository = $entityRepository;
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
            $this->repository->create($this->getDataRequest($request));
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
            'parent_id'     => $request->parent_id,
            'desc'          => $request->desc,
            'link'          => $request->link,
            'active'        => $request->active ?? false,
            'order'         => $request->order ?? 0
        ];
        return $data;
    }

    private function formData(Entity $entity)
    {
        $result = $entity;
        $parent_menu = $this->repository->with('children_menus')->whereNull('parent_id')->orderBy('order', 'asc')->get();
        $exclude_ids = [];
        if ($entity->exists) {
            $result = $this->repository->with('children_menus')->findOrFail($entity->id);
            $exclude_ids = $this->getAllDescendantIds($result);
            $exclude_ids[] = $result->id;
        }
        return [
            'result'        => $result,
            'exclude_ids'   => $exclude_ids,
            'module'        => $this->module,
            'parent_menu'   => $parent_menu,
        ];
    }

    private function getAllDescendantIds($menu)
    {
        $ids = [];
        foreach ($menu->children_menus as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllDescendantIds($child));
        }
        return $ids;
    }
}