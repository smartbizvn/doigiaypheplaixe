<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleCategoryRequest as EntityRequest;
use App\Repositories\ArticleCategory\ArticleCategoryRepositoryInterface as EntityRepositoryInterface;
use App\Models\ArticleCategory as Entity;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Exception;

class ArticleCategoryController extends BaseController
{
    public function __construct(EntityRepositoryInterface $entityRepository)
    {
        $this->module = 'article_categories';
        $this->repository = $entityRepository;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies($this->module . '_access'), 403);
        try {
            list($results, $summary) = $this->repository->list($request);
            $data =  array(
                'results' => $results,
                'summary' => $summary,
                'module' => $this->module
            );
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
            return redirect()->route('admin.' . $this->module . '.index')->with('resp_success', 'Thực hiện thao tác thành công');
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
            return redirect()->route('admin.' . $this->module . '.index')->with('resp_success', 'Thực hiện thao tác thành công');
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
        $featureImage = self::uploadFile($request->file('feature_image'), 'feature_images');
        $image =  $featureImage['link_file'] ?? null;
        $data =  array(
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'url'           => Str::slug($request->name),
            'desc'          => $request->desc,
            'content'       => $request->content,
            'parent_id'     => $request->parent_id ?? null,
            'active'        => $request->active ?? false,
            'feature'       => $request->feature ?? false,
            'show_homepage' => $request->show_homepage ?? false,
            'order'         => $request->order ?? 0,
            'meta_title'    => $request->meta_title,
            'meta_keyword'  => $request->meta_keyword,
            'meta_desc'     => $request->meta_desc
        );
        if ($image !== null) {
            $data['image'] = $image;
            if ($entity && $entity->image) {
                deleteFile($entity->image);
            }
        } elseif ($entity) {
            $data['image'] = $entity->image;
        }
        return $data;
    }

    private function formData(Entity $entity)
    {
        $result = $entity;
        $exclude_ids = [];
        $parent_category = $this->repository->with('children_categories')->whereNull('parent_id')->orderBy('order', 'asc')->get();
        if ($entity->exists) {
            $result = $this->repository->with('children_categories')->findOrFail($entity->id);
            $exclude_ids = $this->getAllDescendantIds($result);
            $exclude_ids[] = $result->id;
        }
        return [
            'result'          => $result,
            'exclude_ids'     => $exclude_ids,
            'module'          => $this->module,
            'parent_category' => $parent_category
        ];
    }

    private function getAllDescendantIds($category)
    {
        $ids = [];
        foreach ($category->children_categories as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllDescendantIds($child));
        }
        return $ids;
    }
}
